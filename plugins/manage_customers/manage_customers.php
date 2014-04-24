<?php
/**
 * Plugin Name: Customer Management
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: A brief description of the Plugin.
 * Version: The Plugin's Version Number, e.g.: 1.0
 * Author: Name Of The Plugin Author
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: A "Slug" license name e.g. GPL2
 */
define('PLUGIN_URL', plugin_dir_url(__FILE__));
// plugin_basename(__FILE__) ;

class Manage_customers
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_actions'));
        add_action('admin_enqueue_scripts', array($this, 'include_scripts')); // to enque scripts in admin , wp_enquene for frontend

        add_action('wp_ajax_customer_go', array($this, 'customerGo'));
    }


    public function include_scripts()
    {
        wp_enqueue_style('style_datepicker', plugins_url('css/style_datepicker.css', __FILE__));
        wp_enqueue_style('multiple_select', plugins_url('css/multiple-select.css', __FILE__));
        wp_enqueue_style('custom', plugins_url('css/custom.css', __FILE__));

        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('multiple_select', plugins_url('js/jquery.multiple.select.js', __FILE__), array('jquery'), null, true);
        wp_enqueue_script('init', plugins_url('js/init.js', __FILE__), array('jquery'), null, true);

        wp_localize_script('init', 'TDAConfig', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'site_url' => site_url()
        ));
    }

    public function add_customer()
    {
        include('form_customer.php');
    }


    public function add_realtor()
    {
        include('form_realtor.php');
    }

    public function add_lender()
    {
        include('form_lender.php');
    }


    public function admin_actions()
    {
        add_menu_page('Manage Customers', 'Manage Customers', 1, 'Add_Customers', '', '', 15);

        add_submenu_page('Add_Customers', 'Add Customers', 'Add Customer', 1, 'Add_Customers', array($this, 'add_customer'));
        add_submenu_page('Add_Customers', 'Add Realtor', 'Add Realtor', 1, 'Add_REALTOR', array($this, 'add_realtor'));
        add_submenu_page('Add_Customers', 'Add Lender', 'Add Lender', 1, 'Add_Lender', array($this, 'add_lender'));
    }

    public function customerGo()
    {
        if ($_POST['action'] === 'customer_go' && wp_verify_nonce($_POST['nonce'], 'customer_go')) {
            $from = $_POST['from'];
            $to = $_POST['to'];

            if (rw_is_date($from)) {
                $from = date('Y-m-d H:i:s', strtotime($from));

                if (rw_is_date($to)) {
                    $to = date('Y-m-d H:i:s', strtotime($to));
                }

                $result = generate_customers_list(array(
                    'from' => $from,
                    'to' => (!empty($to)) ? $to : ''
                ));

                echo json_encode($result);
            }
        }

        exit;
    }
}

$obj = new Manage_customers;