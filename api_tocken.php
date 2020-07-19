<?php

define('BOT_TOKEN', '1234567890:AABBCCDDEEFFJJIIKKLLMMNNs_OPRSTUWXY');
if (!is_file("hook.true")) {

    $inf=file_get_contents("https://api.telegram.org/bot".BOT_TOKEN."/setWebhook?url=https://yoursite.name/vizbot/bot.php");
    $inf=json_decode($inf);

    if ($inf->description=="Webhook was set" || $inf->description=="Webhook is already set") {
        file_put_contents("hook.true", "Ok");
    }
}

?>