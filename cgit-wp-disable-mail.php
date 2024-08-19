<?php

/**
 * Plugin Name:  Castlegate IT WP Disable Mail
 * Plugin URI:   https://github.com/castlegateit/cgit-wp-disable-mail
 * Description:  Disable email sent via the wp_mail function.
 * Version:      1.2.1
 * Requires PHP: 8.2
 * Author:       Castlegate IT
 * Author URI:   https://www.castlegateit.co.uk/
 * License:      MIT
 * Update URI:   https://github.com/castlegateit/cgit-wp-disable-mail
 */

if (!defined('ABSPATH')) {
    wp_die('Access denied');
}

define('CGIT_WP_DISABLE_MAIL_VERSION', '1.2.1');
define('CGIT_WP_DISABLE_MAIL_PLUGIN_FILE', __FILE__);
define('CGIT_WP_DISABLE_MAIL_PLUGIN_DIR', __DIR__);

if (function_exists('wp_mail')) {
    // WordPress mail function is already defined? Show an error message that
    // includes the path of the file that defines the function.
    add_action('admin_notices', function () {
        $location = (new ReflectionFunction('wp_mail'))->getFileName();

        if (is_string($location) && substr($location, 0, strlen(ABSPATH)) === ABSPATH) {
            $location = substr($location, strlen(ABSPATH));
        }

        include __DIR__ . '/views/not-disabled.php';
    });
} else {
    // Replace the default WordPress mail function with a function that does not
    // attempt to send email. If the relevant constant has been defined, log
    // attempts to send mail to a file.
    function wp_mail($to, $subject, $message, $headers = '', $attachments = [])
    {
        if (defined('CGIT_WP_DISABLE_MAIL_LOG')) {
            // Assemble log data, including date and time
            $data = array_merge([
                'datetime' => date('Y-m-d H:i:s'),
            ], compact('to', 'subject', 'message', 'headers'));

            // Save data to log file
            file_put_contents(
                CGIT_WP_DISABLE_MAIL_LOG,
                json_encode($data) . PHP_EOL,
                FILE_APPEND
            );
        }

        return true;
    }

    // Show a warning message on the dashboard, including the path of the log
    // file if it has been defined.
    add_action('admin_notices', function () {
        include __DIR__ . '/views/disabled.php';
    });
}
