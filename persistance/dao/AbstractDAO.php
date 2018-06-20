<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:48
 */

class AbstractDAO
{

    private $user = "s18-bbb2-fst-13";
    private $pwd = "DbPass4b813";
    private $host = "wi-projectdb.technikum-wien.at";
    private $dbname ="s18-bbb2-fst-10";
    protected $conn = null;


    protected function doConnect()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->dbname);
    }

    protected function closeConnect()
    {
        if(!empty($result)) {
            $result->close();
        }
        $this->conn->close();
    }


}
