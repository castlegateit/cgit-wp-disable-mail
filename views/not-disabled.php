<?php

$message = "$title cannot disable mail because <code>wp_mail</code> is already defined";

if ($location) {
    $message .= " in <code>$location</code>";
}

$message .= '.';

?>

<div class="notice notice-error"><p><b>Error:</b> <?= wp_kses_post($message) ?></p></div>
