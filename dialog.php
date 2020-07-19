<?php

if (substr(trim($text), 0, 6)=='/start') {
    if (strlen($user_name)>0) {
        botMessage("Hi, ".$user_name."!");
    }
    $index="A1";
    $keyb=array(
         array('text' => $obj->$index, 'callback_data' => '/more 2')
        );
    $keyboard = array('inline_keyboard' => array($keyb));
    $params = json_encode($keyboard, TRUE);
    $index="Q1";
    botKeyboard($obj->$index, $params);
}

if (substr(trim($text), 0, 5)=='/more') {
    list($comm, $numb)=explode(" ", $text);

    if ($numb>$obj->count) {
        $keyb=array(
            array('text' => "Повторить", 'callback_data' => '/start')
        );
        $mess="Курс закончен.";
    } else {
        $index="A".$numb;
        if (property_exists($users, $chat_id)) {
            $obj->$index=str_replace("%name%", "@".$users->$chat_id, $obj->$index);
        }
        $keyb=array(
            array('text' => $obj->$index, 'callback_data' => '/more '.($numb+1))
        );
        $keyb=array(
            array('text' => $obj->$index, 'callback_data' => '/more '.($numb+1))
        );
        $keyb1=array(
            array('text' => $obj->prev, 'callback_data' => '/more '.($numb-1))
        );
        $index="Q".$numb;
        $mess=$obj->$index;
    }
    if ($numb>1 && $numb<=$obj->count) {
        $keyboard = array('inline_keyboard' => array($keyb, $keyb1));
    } else {
        $keyboard = array('inline_keyboard' => array($keyb));
    }
    $params = json_encode($keyboard, TRUE);
    if (property_exists($users, $chat_id)) {
        $mess=str_replace("%name%", "`".$users->$chat_id."`", $mess);
    }
    botKeyboard($mess, $params);
}


if (substr(trim($text), 0, 5)<>'/more' && substr(trim($text), 0, 6)<>'/start') {
    $res=vizAccountInfo($text);
    if (sizeof($res)==0) {
        botMessage("Аккаунт `".$text."` не найден.\nПроверьте регистрацию и написание.");
    } else {
        $mess="Аккаунт `".$text."` найден!\nВаш соцкапитал: ".$res[0]->vesting_shares;
        $keyb=array(
         array('text' => "Готово!", 'callback_data' => '/more '.$obj->more)
        );
        $keyboard = array('inline_keyboard' => array($keyb));
        $params = json_encode($keyboard, TRUE);
        botKeyboard($mess, $params);
        $users->$chat_id=$text;

        file_put_contents("users.lst", json_encode($users,4));
        botDelMessage($message_id-1);
    }

}

$text="/delmessage";

?>