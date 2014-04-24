<?php include('functions.php');

if (isset($_POST['submit'])) {
    $error = "";
    $name = sanitize_text_field($_POST['name']);
    $company = sanitize_text_field($_POST['company']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $file = $_FILES['realtor_image'];

    if (!is_email($email)) {

        $error = "Invalid Email Address";
    }

    if (empty($error)) {

        $data = array(
            'name' => $name,
            'company' => $company,
            'email' => $email,
            'phone' => $phone
        );

        if (strpos($file['type'], 'image') !== false) {
            $file = rw_upload_attachment($file);
            $url = $file['url'];
            $data['image_uri'] = $url;
        }

        global $wpdb;
        // if you have followed my suggestion to name your table using wordpress prefix
        $table_name = $wpdb->prefix . 'realtors';

        $res = $wpdb->insert($table_name, $data, '%s');



        if ($res) {
            ?>
            <div class="updated"><p><strong><?php _e("Successfully Inserted"); ?> </strong></p></div>   <?php
            ?>
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
    <?php echo "<h2>" . __('Add Realtor', 'oscimp_trdom') . "</h2>"; ?>
    <form method="post" id="realtor_form" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td>Realtor Name</td>
                <td><input type="text" value="" size="30" name="name" id="Realtor Name"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Real Estate Company</td>
                <td><input type="text" value="" size="30" name="company" id="Real Estate Company"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Realtors Email</td>
                <td><input type="text" value="" size="30" name="email" id="Realtors Email"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Realtors Phone</td>
                <td><input type="text" value="" size="20" name="phone" id="Realtors Phone"/>

                    <div class="formClr"></div>
                </td>
                <td></td>
            </tr>

            <tr>
                <td>Upload Image</td>
                <td><input type="file" name="realtor_image" class="image_upload"></td>
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
        <input type="hidden" name="formId" value="3"/>
    </form>
</div>