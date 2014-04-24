<?php
/**
 * =====================================================================
 * Custom Hooks (add_action/add_filter)
 * =====================================================================
 */

/**
 * Initialize the session
 */

function wp_session_start() {
    session_start();
    secure_customer_login();
    secure_customer_logout();
}

add_action( 'init', 'wp_session_start');