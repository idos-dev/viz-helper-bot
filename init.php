<?php
date_default_timezone_set('UTC');

$base=file_get_contents("qa.txt");
$obj=json_decode($base);
$base=file_get_contents("users.lst");
$users=json_decode($base);

$ver = file_get_contents('version.bot');
if (isset($obj->version)) {
    $ver=$ver.".".$obj->version." ";
}
$boticon="F09F939D";

### ПОДКЛЮЧЕНИЕ БИБЛИОТЕК И СОЗДАНИЕ КЛИЕНТА WEBSocket

// подключение библиотеки
   require('vendor/autoload.php');

use WebSocket\Client;
$client = new Client("wss://node.viz.cx/ws");

//задаём наш токен, полученный при создании бота и указываем путь к API телеграма

define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
define('API_FILE_URL', 'https://api.telegram.org/file/bot' . BOT_TOKEN . '/');

define("ROOT_DIR",dirname(__FILE__).'/');
$base_dir=$_SERVER['DOCUMENT_ROOT'];

// подключаем мои закрытые библиотеки функций работы

include_once 'admin/functions.php';

?>