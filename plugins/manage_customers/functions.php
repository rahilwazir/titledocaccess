<?php
// 'ad'  Prefix For my custom Defined Fucntions 
function ad_value_form($name)
{
    if (isset($_POST['submit'])) {
        return 'value="' . $_POST[$name] . '"';
    } else {
        return 'value=""';
    }
}