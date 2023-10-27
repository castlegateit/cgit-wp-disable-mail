<?php

$message = "$title is blocking all mail sent from this site.";

if (defined('CGIT_WP_DISABLE_MAIL_LOG') && is_string(CGIT_WP_DISABLE_MAIL_LOG)) {
    $message .= ' Mail will be logged to <code>' . CGIT_WP_DISABLE_MAIL_LOG . '</code> instead.';
}

?>

<div class="notice notice-warning"><p><b>Notice:</b> <?= wp_kses_post($message) ?></p></div>
