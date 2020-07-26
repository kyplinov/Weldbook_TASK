<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/Commands/AbstractRecovery.php';

class AddRecord extends AbstractRecovery{

    public function execute()
    {
        echo "Data restored<br>";
        $this->addDump();
        // TODO: Implement execute() method.
    }

    public function addDump(){
        $strDupm = $this->getDumpStr(); ///Получаем дамп в массиве
        $sqlPref = str_replace("id, ","", $strDupm)[1]; ////Извекаем поля таблицы
        $connect = DBconnect::getConnect(); //Получааем объект класса подключения к БД

        $maxId = (($connect->query("Select max(`id`)  from test"))->fetch_row())[0]; //получаем максимальное значение ID в таблице
        $maxId +=2;

        foreach (array_slice($strDupm, $maxId) as $item) //перебираем массив значение начиная с максимального элемента в таблице
        {

            $arr_item = explode(',',trim($item, '()')); //убираем лишние символы и переводим строку в массив
            $arr_item = substr(implode(',', array_slice($arr_item,1)),0,-1); //убираем id и переводим массив в строку
            $sql_in = $sqlPref. ' (' .$arr_item; // собираем запрос
            $connect->query($sql_in); //отправляем запрос в метод класса DBconnect

        }

    }

}