<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/Commands/AbstractRecovery.php';

class ReplaceRecord extends AbstractRecovery {

    public function execute()
    {
        echo "Data restored<br>";
        $this->replaceDump();
        // TODO: Implement execute() method.
    }

    public function replaceDump(){
        $connect = DBconnect::getConnect(); ////Получааем объект класса подключения к БД
        $strDump = implode(array_slice($this->getDumpStr(),1)); //переводим массив в строку
        $deleteSql = "DELETE FROM test"; //удаляем все содержимое таблицы
        $connect->query($deleteSql); //отправляем запрос в метод класса DBconnect
        $connect->query($strDump); //отправляем запрос в метод класса DBconnect

    }
}