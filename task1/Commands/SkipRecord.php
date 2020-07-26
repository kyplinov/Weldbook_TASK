<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/Commands/AbstractRecovery.php';

class SkipRecord extends AbstractRecovery{
    public function execute()
    {
        echo "Data restored<br>";
        $this->skipDump();
        // TODO: Implement execute() method.
    }

    public function skipDump() {
        $strDupm = $this->getDumpStr(); //Получаем дамп в массиве
        $sqlPref = str_replace("id, ","", $strDupm)[1]; //Извекаем поля таблицы
        $connect = DBconnect::getConnect(); //Получааем объект класса подключения к БД
        foreach (array_slice($strDupm, 2) as $item) //смещение на 3 позиции в массие - со 3й строки начинаются значения
        {

            $arr_item = explode(',',trim($item, '()')); //убираем скобки, переводим строку в массив по разделителю
            $id_item = array_slice($arr_item, 0, 1); //возвращаем массив без id
            $arr_item = substr(implode(',', array_slice($arr_item,1)),0,-1); //переводим массив в строку с разделителем и убираем лишние символы

            $sql_in = $sqlPref. ' (' .$arr_item.'ON DUPLICATE KEY UPDATE id='.implode($id_item); //собираем sql запрос

            $connect->query($sql_in); //отправляем запрос в метод класса DBconnect
        }
    }
}