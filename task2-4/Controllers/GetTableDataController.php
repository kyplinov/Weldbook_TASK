<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/task2-4/DBConnect/DBConnect.php'; //Класс подключения БД
require_once $_SERVER['DOCUMENT_ROOT'] . '/task2-4/Repositories/RegisterRepository.php';

class GetTableDataController
{
    /**
     * @param $cfg
     * @return false|string
     */
    public function getTableData($cfg)
    {
        $repository = new RegisterRepository(DBconnect::getConnect());
        try {
            $data = $repository->getTableData($cfg);
            $response = [
                'status' => 1,
                'error' => '',
                'data' => $data
            ];
        }catch (Exception $err) {
            $response = [
                'error' => $err->getMessage(),
                'status' => 0
            ];
        }



        return json_encode($response);
    }
}