<?php include('functions.php');

if (isset($_POST['submit'])) {
    $error = "";
    $name = sanitize_text_field($_POST['name']);
    $agent = sanitize_text_field($_POST['agent']);
    $phone = sanitize_text_field($_POST['phone']);
    $file = $_FILES['lender_image'];

    $email = $_POST['email'];
    $email = sanitize_email($email);

    if (!is_email($email)) {

        $error = "Invalid Email Address";
    }


    if (empty($error)) {

        $data = array(
            'name' => $name,
            'agent' => $agent,
            'phone' => $phone,
            'email' => $email
        );

        if (strpos($file['type'], 'image') !== false) {
            $file = rw_upload_attachment($file);
            $url = $file['url'];
            $data['image_uri'] = $url;
        }

        global $wpdb;
        // if you have followed my suggestion to name your table using wordpress prefix
        $table_name = $wpdb->prefix . 'lenders';

        $res = $wpdb->insert($table_name, $data);

        if ($res) {
            ?>
            <div class="updated"><p><strong><?php _e("Successfully Inserted"); ?> </strong></p></div>
            <script>

                var delay = 1000;//1 seconds
                setTimeout(function () {

                    window.location.reload();  //your code to be executed after 1 seconds
                }, delay);

            </script> <?php

        }


    } else {
        ?>
        <div class="updated"><p><strong><?php _e($error); ?> </strong></p></div>
    <?php
    }
}
?>
    <div class="wrap">
        <?php echo "<h2>" . __('Add Lender ', 'oscimp_trdom') . "</h2>"; ?>
        <form method="post" id="userForm" action="" enctype="multipart/form-data">

            <table border="0">


                <tr>
                    <td>Lender Name</td>
                    <td><input type="text" <?php echo ad_value_form('name'); ?> size="30" name="name" id="Lender Name"/>

                        <div class="formClr"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Lending Agent</td>
                    <td><input type="text" <?php echo ad_value_form('agent'); ?> size="30" name="agent"
                               id="Lending Agent"/>

                        <div class="formClr"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Lender Phone</td>
                    <td><input type="text" <?php echo ad_value_form('phone'); ?> size="20" name="phone"
                               id="Lender Phone "/>

                        <div class="formClr"></div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Lender Email</td>
                    <td><input type="text" <?php echo ad_value_form('email'); ?> size="30" name="email"
                               id="Lender Email"/>

                        <div class="formClr"></div>
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td>Upload Image</td>
                    <td><input type="file" name="lender_image" class="image_upload"></td>
                    <td></td>
                    <script>
                        jQuery(function($) {
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    if (input.files[0].type.indexOf('image/') === -1) {
                                        alert('Please select an image');
                                        input.value = "";
                                        return false;
                                    }
                                }
                            }
                            $(document).on('change', 'input.image_upload', function() {
                                readURL(this);
                            });
                        });
                    </script>
                </tr>

                <td>Submit</td>
                <td><input type="submit" value="Submit" name="submit" id="Submit"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
                </tr>
            </table>
            <input type="hidden" name="formId" value="3"/></form>
    </div>