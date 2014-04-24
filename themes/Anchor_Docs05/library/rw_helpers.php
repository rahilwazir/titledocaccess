<?php
/**
 * =====================================================================
 * Custom helpers
 * =====================================================================
 */

/**
 * Uploads attachment to the wordpress directory
 * @param array $files Should be $_FILES['file_input_name']
 * @return mixed
 */
function rw_upload_attachment(array $files)
{
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    $uploadedfile = $files;

    if (strpos($files['type'], 'image/') !== false) {
        $upload_overrides = array( 'test_form' => false );
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

        if ( $movefile ) {
            return $movefile;
        }
    }

    return false;
}

/**
 * Secure Frontend Customer Login
 */
function secure_customer_login()
{
    global $wpdb;
    if ( isset($_POST['submit']) && wp_verify_nonce($_POST['_wpnonce'], 'customer_login') ) {
        if (isset($_POST['log']) && isset($_POST['pwd'])) {
            $log = sanitize_text_field($_POST['log']);
            $pwd = intval(sanitize_text_field($_POST['pwd']));

            $rm_me = isset($_POST['rememberme']) ? true : false;

            $sql = "
              SELECT last_name, security_no, realtor_id, lender_id
              FROM {$wpdb->prefix}customers
                WHERE last_name = '$log' AND security_no = '{$pwd}' LIMIT 1
            ";
            
            $results = $wpdb->get_results( trim($sql), ARRAY_A );

            if ($results) {
                $time = ($rm_me) ? ((time()) + (3600 * 24 * 14)) : 0;
                
                $result = $results[0];
                $_SESSION['last_name'] = $result['last_name'];
                $_SESSION['security_no'] = $result['security_no'];
                $_SESSION['realtor_id'] = $result['realtor_id'];
                $_SESSION['lender_id'] = $result['lender_id'];

                setcookie("customer_details", $result['last_name'] . ' ', $time);
            }
        }
        
        wp_redirect(site_url()); exit;
    }
}

/**
 * Secure Frontend Customer Login
 */
function secure_customer_logout()
{
    if ( isset($_POST['customer_logout']) && wp_verify_nonce($_POST['_wpnonce'], 'customer_logout') ) {
        session_destroy();
//        setcookie("customer_details", "", time()-3600);

        wp_redirect(site_url()); exit;
    }
}

/**
 * Check if customer is logged in
 */
function is_customer_logged_in()
{
    return (isset($_SESSION['security_no']) && isset($_SESSION['last_name'])) ? true : false;
}

/**
 * Get Lender Details
 * @param string $customer_id
 */
function getLenderDetails($customer_id = '')
{
    global $wpdb;
    
    if ( empty($customer_id) ) {
        $sql = "
            SELECT name, agent, phone, email, image_uri
                FROM {$wpdb->prefix}lenders
                WHERE id = {$_SESSION['lender_id']} LIMIT 1;
        ";
        
    } else {
        $email = sanitize_email($customer_id);
        
        $sql = "
            SELECT l.name, l.agent, l.email, l.phone, l.image_uri
                FROM {$wpdb->prefix}customers c
        	        JOIN {$wpdb->prefix}lenders as l
        	            ON c.lender_id = l.id
                WHERE c.email = '{$email}' LIMIT 1
        ";
    }
    
    $results = $wpdb->get_results( trim($sql), ARRAY_A );

    if ($results) {
        return $results[0];
    }

    return false;
}

/**
 * Get Realtor Details
 */
function getRealtorDetails($customer_id = '')
{
    global $wpdb;
    
    if ( empty($customer_id) ) {
        $sql = "
            SELECT name, company, email, phone, image_uri
                FROM {$wpdb->prefix}realtors
                WHERE id = {$_SESSION['realtor_id']} LIMIT 1;
        ";
    } else {
        $email = sanitize_email($customer_id);
        
        $sql = "
            SELECT r.name, r.company, r.email, r.phone, r.image_uri
                FROM {$wpdb->prefix}customers c
                    JOIN {$wpdb->prefix}realtors as r
                        ON c.realtor_id = r.id
                WHERE c.email = '{$email}' LIMIT 1
        ";
    }
    
    $results = $wpdb->get_results( trim($sql), ARRAY_A );

    if ($results) {
        return $results[0];
    }

    return false;
}

function getCustomerCookie($left = true)
{
    if (isset($_COOKIE['customer_details'])) {
        $cd = $_COOKIE['customer_details'];

        $result = explode(' ', $cd);
        return $result[0];
    } else {
        return '';
    }
}

function defaultCLRImage()
{
    return get_template_directory_uri() . '/images/defaultCLRImage.png';
}

function exists_in_db($key, $value, $table = 'customers')
{
    global $wpdb;

    $value = (is_email($value)) ? sanitize_email($value) : sanitize_text_field($value);

    $sql = "
        SELECT $key FROM
        {$wpdb->prefix}$table WHERE $key = '$value'
    ";

    $data = $wpdb->get_results(trim($sql), ARRAY_A);

    if ($data && array_key_exists($key, $data[0]) ) {
        return true;
    }

    return false;
}

function generate_customers_list(array $args = array())
{
    global $wpdb;

    extract($args);

    $sql = "SELECT sid id, first_name f, last_name l FROM {$wpdb->prefix}customers c";

    if ($from) {
        $sql .= " JOIN {$wpdb->prefix}newsletter n";
        $sql .= " ON c.sid = n.id";
        $sql .= " WHERE n.created >= '$from'";

        if ($to) {
            $sql .= " AND n.created <= '$to'";
        }
    }
    
    if ($email) {
        $sql .= " WHERE email = '{$email}'";
    }

    $data = $wpdb->get_results(trim($sql));

    if ($data) {
        return $data;
    }

    return false;
}

function rw_is_date($date)
{
    $date = explode('/', $date);

    $date = array_map('intval', $date);

    if ( checkdate($date[0], $date[1], $date[2]) ) {
        return true;
    }

    return false;
}