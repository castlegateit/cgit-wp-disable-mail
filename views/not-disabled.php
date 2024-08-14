<?php

$message = sprintf(__('Mail cannot be disabled because %s is already defined.'), '<code>wp_mail</code>');

if ($location) {
    $message = sprintf(__('Mail cannot be disabled because %s is already defined in %s.'), '<code>wp_mail</code>', '<code>' . $location . '</code>');
}

?>

<div class="notice notice-error">
    <p><b><?= esc_html__('Error:') ?></b> <?= wp_kses_post($message) ?></p>
</div>
