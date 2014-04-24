<?php

add_shortcode('customer_info', 'customer_info');

function customer_info ($atts, $content = null) {
    extract(shortcode_atts(array(
        'customer_id' => '',
    ), $atts) );
    
    $lender = getLenderDetails( $customer_id );
    $realtor = getRealtorDetails( $customer_id );

    if ($lender) {
    ?>
        <section class="fleft" id="lender" style="float: left; text-align: left;">
            <div id="lender_image" class="lrimg fleft" style="width: 92px; margin: 0 5px; float: left;">
                <img style="max-width: 100%;" src="<?php echo ($lender['image_uri']) ? $lender['image_uri'] : defaultCLRImage(); ?> ">
            </div>
            <div class="fleft" style="float: left;">
                <span><strong>Name: </strong><?php echo $lender['name']; ?></span><br>
                <span><strong>Agent: </strong><?php echo $lender['agent']; ?></span><br>
                <span><strong>Phone: </strong><?php echo $lender['phone']; ?></span><br>
                <span><strong>Email: </strong><a href="mailto:<?php echo $lender['email']; ?>"><?php echo $lender['email']; ?></a></span>
            </div>
        </section>
    <?php
    }

    if ($realtor) {
    ?>
        <section class="fright" id="realtor" style="float: right; text-align: right;">
            <div id="realtor_image" class="lrimg fright" style="width: 92px; margin: 0 5px; float: right;">
                <img style="max-width: 100%;" src="<?php echo ($realtor['image_uri']) ? $realtor['image_uri'] : defaultCLRImage(); ?> ">
            </div>
            <div class="fright" style="float: right;">
                <span><strong>Name: </strong><?php echo $realtor['name']; ?></span><br>
                <span><strong>Agent: </strong><?php echo $realtor['company']; ?></span><br>
                <span><strong>Phone: </strong><?php echo $realtor['phone']; ?></span><br>
                <span><strong>Email: </strong><a href="mailto:<?php echo $realtor['email']; ?>"><?php echo $realtor['email']; ?></a></span>
            </div>
        </section>
    <?php
    }
    echo ($lender || $realtor) ? '<div class="cleared space-bottom" style="clear: both;"></div>' : '';

    if (!empty($customer_id)) {
        $customer = generate_customers_list(array('email' => $customer_id));
        
        if ($customer) {
            $customer = $customer[0];
            
            echo '<h3>' . ucwords($customer->f) . ' ' . ucwords($customer->l) . '</h3>';
        }
    }
    
    echo '<div class="cleared space-bottom" style="clear: both;"></div>';
}

add_shortcode('box_dot_com', 'boxDotCom');

function boxDotCom($atts, $content = null)
{
    extract(shortcode_atts(array(
        'text_for_guests' => ''
    ), $atts) );

    if (is_customer_logged_in()) {
        $nonce = wp_create_nonce('user_box_com');

        $requst_header = array(
            'sslverify' => false
        );

        /*$data = wp_remote_get('https://www.box.com/api/oauth2/authorize?response_type=code&client_id=2p3itbllti4eyzwrljxmlnq2zqqdfl4k&state=' . $nonce, $requst_header);
        echo wp_remote_retrieve_body($data);*/

        return '<div class="cleared"></div>
                <iframe src="https://app.box.com/embed_widget/s/7i514hqkoycvx0aa89fm?view=icon&sort=date&direction=ASC&theme=gray" width="100%" height="300" frameBorder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>';
    } else {
        return $text_for_guests;
    }
}