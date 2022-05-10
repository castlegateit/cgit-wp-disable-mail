<?php

/*

Plugin Name: Castlegate IT WP Disable Mail
Plugin URI: http://github.com/castlegateit/cgit-wp-disable-mail
Description: Disable email sent with the wp_mail function.
Version: 1.0
Author: Castlegate IT
Author URI: http://www.castlegateit.co.uk/
License: MIT

*/

$notice = '<b>Error:</b> %s cannot disable email. Please disable any other plugins that might send email.';

if (!function_exists('wp_mail')) {
    $notice = '<b>Important:</b> %s is preventing this site from sending email.';

    function wp_mail($to, $subject, $message, $headers = '', $attachments = [])
    {
        return true;
    }
}

add_action('admin_notices', function () use ($notice) {
    $plugin = get_plugin_data(__FILE__);
    $name = $plugin['Name'] ?? basename(__FILE__);

    echo '<div class="notice error"><p>' . sprintf($notice, $name) . '</p></div>';
});
