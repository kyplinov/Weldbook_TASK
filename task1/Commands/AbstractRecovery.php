<?php

/* Задаем общий интерфейс для классов команд */

abstract class AbstractRecovery{

    public $pathDump = '/sql/table_test_data.sql';  //Копия БД

    abstract public function execute();

    public function getDumpStr()
    {

        return file($_SERVER['DOCUMENT_ROOT'] . '/task1'.$this->pathDump, FILE_IGNORE_NEW_LINES); //читаем файл дампа
    }
}