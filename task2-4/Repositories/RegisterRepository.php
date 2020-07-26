<?php

class RegisterRepository
{
    /** @var Mysqli */
    private $dbConnect;

    /**
     * RegisterRepository constructor.
     * @param Mysqli $dbConnect
     */
    public function __construct($dbConnect)
    {
        $this->dbConnect = $dbConnect;
    }

    /**
     * @return Mysqli
     */
    private function getDbConnect()
    {
        return $this->dbConnect;
    }

    /**
     * @param $cfg
     * @return array
     * @throws Exception
     */
    public function getTableData($cfg)
    {
        $headStrApi = implode(', ',$this->getHeadStr());
        $sort = $this->getSortSql($cfg['sort']);
        $page = $this->getPageSql($cfg['page']);
        $limit = $this->getLimitSql($cfg['limit']);
        $filter = $this->getFilter($cfg['filterName'], $cfg['filterValue']);
        $bodyArrApi = [];


        $sqlData = "SELECT * FROM test ".$filter." ".$sort ." LIMIT ".$page.", ".$limit;
        $resDataApi = $this->getDbConnect()->query($sqlData)->fetch_all();


        foreach ($resDataApi as $DataApi) {
            array_push($bodyArrApi, substr(implode(', ', $DataApi), 0 , -2));

        }

        return [
            'head' =>  $headStrApi,
            'body' => $bodyArrApi
        ];
    }

    /**
     * @param $sort
     * @return string
     */


    private function getHeadStr(){
        $headArrApi = [];
        $sqlNameColumns = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = 'test' AND table_schema = 'test' ";
        $resNameColumns = $this->getDbConnect()->query($sqlNameColumns)->fetch_all();

        foreach ($resNameColumns as $nameColumn){
            array_push($headArrApi, $nameColumn[0]);
        }

        return $headArrApi;
    }

    private function getFilter($filterName, $filterValue){

        if (!isset($filterName)){
            echo "filter".$filterName."<br>";
            return "";
        }

        if (in_array($filterName, $this->getHeadStr()))
        {
            $filter = " WHERE `".$filterName."` = '".$filterValue."' ";
        } else {
            throw new Exception('Invalid field name');
        }

        return $filter;

    }


    private function getSortSql($sort)
    {
        switch ($sort) {
            case "up":
                $sort = "ORDER BY id DESC";
                break;
            case "down":
                $sort = "ORDER BY id ASK";
                break;
            default:
                $sort = "";
        }

        return $sort;
    }

    /**
     * @param $limit
     * @return mixed
     * @throws Exception
     */
    private function getLimitSql($limit)
    {
        if (empty($limit)) {
            throw new Exception('Data limit not specified');
        }

        return $limit;
    }

    /**
     * @param $page
     * @return float|int
     * @throws Exception
     */
    private function getPageSql($page)
    {
        if (empty($page)) {
            throw new Exception('No page specified');
        }
        if (+$page === 1) {
            $sqlPage = $page;
        } else {
            $sqlPage = --$page * 50;
        }

        return $sqlPage;
    }


}