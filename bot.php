<?php

$check_time=microtime();
$text="";
$chat_id=null;
//file_put_contents("warning.log", date("d-m-Y H:i:s", time())." | ".$_SERVER['HTTP_USER_AGENT']." | ".$_SERVER['REQUEST_URI']."\n", FILE_APPEND | LOCK_EX);

//задаём наш токен, полученный при создании бота и указываем путь к API телеграма
include_once 'api_tocken.php';

include_once 'inc_bot/init.php'; // подключаем библиотеки

//принимаем запрос от бота(то, что напишет в чате пользователь)
$content = file_get_contents('php://input');
//botMessage($content);
if (strlen($content)>0) {
   //превращаем из json в массив
   $update = json_decode($content, TRUE);
   $user_name="";
   if (isset($update['message'])) {
   //получаем текст запроса
      $text = isset($update['message']['text'])?$update['message']['text']:"";
      $user_id = $update['message']['from']['id'];
   //получаем id чата
      $chat_id = $update['message']['chat']['id']; // при ответе от кнопки - пустой
      $user_name = isset($update['message']['from']['username'])?$update['message']['from']['username']:"";
      $message_id = $update['message']['message_id'];
      if (trim($user_name)=="") {
         $user_name=(isset($update['message']['from']['first_name'])?$update['message']['from']['first_name']:"")." ".(isset($update['message']['from']['last_name'])?$update['message']['from']['last_name']:"");
         $user_name=trim($user_name);
      }
      if (trim($user_name)=="") {
          $user_name="u-".substr($chat_id, -5);
      }
      $file_id = isset($update['message']['document']['file_id'])?$update['message']['document']['file_id']:"";
      $file_name = isset($update['message']['document']['file_name'])?$update['message']['document']['file_name']:"";
}
   // Обработка кнопок
   // получаем ответ от кнопки

   if (isset($update['callback_query'])) {
      $callback_query = $update['callback_query'];

   // получаем ещё какие-то данные от кнопок
      $text = $callback_query['data']; // Если пришёл ответ, то тут текст команды коллбэка
      $message_id = $callback_query['message']['message_id']; // зачем нам это? Можно удалить по id!
      $chat_id = $callback_query['message']['chat']['id'];
      $user_id = $callback_query['message']['from']['id'];
   }

} // content

$admin=FALSE;

if ($chat_id==111111111 || $chat_id==222222222 || $chat_id==333333333) {
    $admin=TRUE;
}

include_once 'inc_bot/update.php'; // обновление qa
include_once 'inc_bot/dialog.php'; // диалог по сценарию

if (trim($text)=='/delmessage') {
    botDelMessage($message_id);
}

echo "Ok. ".(microtime()-$check_time);
?>