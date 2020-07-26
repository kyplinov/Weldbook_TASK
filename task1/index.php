<?php

require_once $_SERVER['DOCUMENT_ROOT'] .'/task1/DBConnect.php'; //Класс подключения БД
require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/Mediators/RecoveryDump.php'; //Класс создания команды на востановление данных
require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/Constants/TypeRecovery.php'; //Класс констант команд

/*

    REPLACE_RECORD  - Заменить данные
    ADD_RECORD      - Дописать данные
    SKIP_RECORD     - Пропустить данные

 */


$test = new RecoveryDump();
$RecoveryTest = $test->createRecoveryDump(SKIP_RECORD);
$RecoveryTest->execute();




