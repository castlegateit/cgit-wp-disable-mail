<?php

$parts = [];
$parts[] = __('Castlegate IT WP Disable Mail is blocking all mail sent from this site.');

if (defined('CGIT_WP_DISABLE_MAIL_LOG') && is_string(CGIT_WP_DISABLE_MAIL_LOG)) {
    $parts[] = sprintf(__('Mail will be logged to %s instead.'), '<code>' . CGIT_WP_DISABLE_MAIL_LOG . '</code>');
}

$message = implode(' ', $parts);

?>

<div class="notice notice-warning">
    <p><b><?= esc_html__('Notice:') ?></b> <?= wp_kses_post($message) ?></p>
</div>
