<?php
/**
 * Created by PhpStorm.
 * User: sklo
 * Date: 24.05.2018
 * Time: 18:48
 */

class AbstractDAO
{

    private $user = "root";
    private $pwd = "";
    private $host = "127.0.0.1";
    private $dbname ="computecherp";
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