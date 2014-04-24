<?php
include('functions.php');
global $wpdb, $newsletter;

/*
 * ====================================================
 * Customer Form Submission
 * ====================================================
 */

if (isset($_POST['submit'])) {
    $errors = array();
    $first_name = sanitize_text_field($_POST['customer_first_name']);
    $last_name = sanitize_text_field($_POST['customer_last_name']);
    $security_no = sanitize_text_field($_POST['security_no']);
    $file_no = sanitize_text_field($_POST['file_no']);
    $file_no = intval($file_no);

    $email = sanitize_email($_POST['email']);

    if (empty($email)) {
        $errors[] = "Email Address is required";
    } else if (!is_email($email)) {
        $errors[] = "Invalid Email Address";
    }

    if (exists_in_db('email', $email)) {
        $errors[] = 'Email Already Exists.';
    }

    if (trim($security_no) === '' ) {
        $errors[] = 'Security No. is required.';
    }
    
    if (!preg_match('/^\d{5}$/', $security_no)) {
        $errors[] = 'Security No. Should only contain numeric characters and should not less or greator than 5 characters';
    }

    if (exists_in_db('security_no', $security_no)) {
        $errors[] = 'Security No. Already Exist';
    }

    $sel_real_name = sanitize_text_field($_POST['sel_real_name']);
    $sel_real_company = sanitize_text_field($_POST['sel_real_company']);
    $sel_real_email = sanitize_email($_POST['sel_real_email']);
    $sel_real_phone = intval($_POST['sel_real_phone']);

    $realtor_id = sanitize_text_field($_POST['realtor_id']);
    $realtor_id = intval($realtor_id);

    $lender_id = sanitize_text_field($_POST['lender_id']);
    $lender_id = intval($lender_id);

    $closing_date = sanitize_text_field($_POST['closing_date']);

    $closing_office = sanitize_text_field($_POST['closing_office']);

    if (empty($errors)) {

        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'security_no' => $hash_secuirty_no,
            'file_no' => $file_no,
            'email' => $email,
            'realtor_id' => $realtor_id,
            'lender_id' => $lender_id,
            'closing_date' => $closing_date,
            'closing_office' => $closing_office,
            'sel_real_name' => $sel_real_name,
            'sel_real_company' => $sel_real_company,
            'sel_real_email' => $sel_real_email,
            'sel_real_phone' => $sel_real_phone
        );

        // if you have followed my suggestion to name your table using wordpress prefix
        $table_name = $wpdb->prefix . 'customers';

        $res = $wpdb->insert($table_name, $data);

        if ($res) {
            // newsletter plugin addition
            $user['email'] = $email;
            $user['status'] = 'C';

            if ($newsletter->save_user($user, OBJECT)) {
                $sid = absint($wpdb->insert_id);

                $sql = "
                    UPDATE {$wpdb->prefix}customers SET sid = %d WHERE email = '%s'
                ";

                if (exists_in_db('email', $email)) {
                    $result = $wpdb->query( $wpdb->prepare(trim($sql), $sid, $email) );
                }
            ?>
            <div class="updated"><p><strong><?php _e("Successfully Inserted"); ?> </strong></p></div>
        <?php
            }
        }
    } else { ?>
        <div class="<?php echo (!empty($errors)) ? 'error' : 'updated'; ?>">
            <?php rsort($errors); foreach ($errors as $error) : ?>
            <p><strong><?php _e($error); ?> </strong></p>
            <?php endforeach; ?>
        </div>
    <?php
    }
}

/**
 * ====================================================
 * Realtors Data
 * ====================================================
 */
$rows = $wpdb->get_results("SELECT id,name FROM " . $wpdb->prefix . "realtors");

$realtor = array();

if ($rows) {
    foreach ($rows as $row) {
        $id = $row->id;
        $name = $row->name;
        $realtor[$id] = $name;

    }
}

/*
 * ====================================================
 * Lenders Data
 * ====================================================
 */
$rows = $wpdb->get_results("SELECT id,name FROM " . $wpdb->prefix . "lenders");
$lender = array();
if ($rows) {
    foreach ($rows as $row) {
        $id = $row->id;
        $name = $row->name;
        $lender[$id] = $name;

    }
}
?>
<div class="wrap">
    <?php echo "<h2>" . __('Add Customer ', 'oscimp_trdom') . "</h2>"; ?>


    <form method="post" id="userForm">

        <table border="0">

            <tr>
                <td>Customer First Name (*)</td>
                <td><input type="text" <?php echo ad_value_form('customer_first_name'); ?> size="30" name="customer_first_name"
                           id="Customer Name"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>

            <tr>
                <td>Customer Last Name (*)</td>
                <td><input type="text" <?php echo ad_value_form('customer_last_name'); ?> size="30" name="customer_last_name"
                           id="Customer Name"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>

            <tr>
                <td>Last 5 Numbers of Social Security (*)</td>
                <td><input type="text" <?php echo ad_value_form('security_no'); ?> size="5" name="security_no"
                           id="Last 5 Numbers of Social "/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Customer File #</td>
                <td><input type="text" <?php echo ad_value_form('file_no'); ?> size="20" name="file_no"
                           id="Customer File Number"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Customer Email (*)</td>
                <td><input type="text" <?php echo ad_value_form('email'); ?> size="30" name="email"
                           id="Customer Email"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>


            <tr>
                <td><h3> BUYERS REALTOR </h3>
                <td>
            </tr>

            <hr/>
            <tr>
                <td>Select Realtor</td>

                <td><select name="realtor_id"
                            id="Select Realtor"> <?php foreach ($realtor as $id => $name) echo '<option  value="' . $id . '"> ' . $name . '</option>'; ?> </select>

                    <div class="formClr"></div>
                </td>

            </tr>


            <tr>
                <td><h3> SELLERS REALTOR </h3>
                <td>
            </tr>


            <tr>
                <td>Sellers Realtor</td>
                <td><input type="text" value="" size="30" name="sel_real_name" id="Sellers Realtor Name"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Sellers Realtor Company</td>
                <td><input type="text" value="" size="30" name="sel_real_company" id="Sellers Realtor Company"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Sellers Realtor Email</td>
                <td><input type="text" value="" size="30" name="sel_real_email" id="Sellers Realtor Email"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Sellers Realtor Phone</td>
                <td><input type="text" value="" size="30" name="sel_real_phonr" id="Sellers Realtor Phone"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>

            <tr>
                <td><h3> LENDER </h3>
                <td>
            </tr>


            <tr>
                <td>Select Lender</td>
                <td><select name="lender_id"
                            id="Select Realtor"><?php foreach ($lender as $id => $name) echo '<option  value="' . $id . '"> ' . $name . '</option>'; ?> </select>

                    <div class="formClr"></div>
                </td>

            </tr>


            <tr>
                <td>Closing Date</td>
                <td>


                    <input class="datepicker" name="closing_date" type="text" value=""/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Closing Office (*)</td>
                <td><input name="closing_office" type="checkbox" value="Orange Beach, AL" id="Closing Office0"/><label
                        for="Closing Office0">Orange Beach, AL </label><input name="form[Closing Office][]"
                                                                              type="checkbox" value="Mobile, AL"
                                                                              id="Closing Office1"/><label
                        for="Closing Office1">Mobile, AL</label>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Submit</td>
                <td><input type="submit" value="Submit" name="submit" id="submit"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
        </table>
        <input type="hidden" name="formId" value="3"/></form>
</div>