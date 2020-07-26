<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/Commands/AbstractRecovery.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/Constants/TypeRecovery.php';



class RecoveryDump {
    public static function createRecoveryDump(?string $typeRecovery): AbstractRecovery
    {
        $recovery = null;
        switch ($typeRecovery) {
            case TypeRecovery::REPLACE_RECORD:
                $recovery = new ReplaceRecord();  //Заменить данные
                break;
            case TypeRecovery::ADD_RECORD:
                $recovery = new AddRecord(); //Дописать данные
                break;
            case TypeRecovery::SKIP_RECORD:
                $recovery = new SkipRecord(); //Пропустить данные
                break;
        }

        return $recovery;
    }
}