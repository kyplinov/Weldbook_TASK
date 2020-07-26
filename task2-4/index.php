<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/task2-4/Controllers/GetTableDataController.php';

$controller = new GetTableDataController();

$cfg = [
    'limit' => $_GET['limit'],
    'page' => $_GET['page'],
    'sort' => $_GET['sort'],
    'filterName' => $_GET['filterName'],
    'filterValue' => $_GET['filterValue']
];

echo $controller->getTableData($cfg);

return $controller->getTableData($cfg);