<?php

define('HOST', 'localhost'); //сервер
define('USER', 'root'); //пользователь
define('PASSWORD', ''); //пароль
define('NAME_BD', 'test');//база


/* класс подключения к БД */
class DBconnect {

    private $connectDB;

    private static $_dbCon = []; // статическое поле для хранения объекта класса


    /* Метод создания экземпляра класса подключения к БД */
    public static function getConnect(): DBconnect
    {
        $con = static::class;
        if (!isset(self::$_dbCon[$con])) //если экземляр не создан
        {
            self::$_dbCon[$con] = new static; // создаем экземляр класса
        }
        return self::$_dbCon[$con]; //иначе возвращаем уже имеющийся экземпляр
    }

    private function __construct()
    {
        $connect = new mysqli(HOST, USER, PASSWORD, NAME_BD); //подключение к БД

        if ($connect -> connect_error) {
            printf("Соединение не удалось: %s\n", $connect -> connect_error);
            exit();
        }

        $this->connectDB=$connect;

    }

    /* метод для query запроса */
    public function query($sql)
    {
       return $this->connectDB->query($sql);
    }

}





