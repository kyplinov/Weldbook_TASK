<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/Commands/SkipRecord.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/Commands/AddRecord.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/task1/Commands/ReplaceRecord.php';

class TypeRecovery {
    const REPLACE_RECORD = 'REPLACE_RECORD';
    const ADD_RECORD = 'ADD_RECORD';
    const SKIP_RECORD = 'SKIP_RECORD';
}