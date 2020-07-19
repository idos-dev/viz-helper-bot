<?php

if ($admin && isset($file_id) && $file_id<>"" && $file_name=="qa.txt") {
    if (getDocument($file_id, $file_name, $base_dir."/vizbot/")) {
        $base=file_get_contents("qa.txt");
        $obj=json_decode($base);

    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            $mess= ' Ошибок нет';
        break;
        case JSON_ERROR_DEPTH:
            $mess= ' Достигнута максимальная глубина стека';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            $mess= ' Некорректные разряды или не совпадение режимов';
        break;
        case JSON_ERROR_CTRL_CHAR:
            $mess= ' Некорректный управляющий символ';
        break;
        case JSON_ERROR_SYNTAX:
            $mess= ' Синтаксическая ошибка, не корректный JSON';
        break;
        case JSON_ERROR_UTF8:
            $mess= ' Некорректные символы UTF-8, возможно неверная кодировка';
        break;
        default:
            $mess= ' Неизвестная ошибка';
        break;
    }

        botMessage("Update passed:\n".$mess);
        $text="/start";
    }
}


?>