<?php
class DB
{

    private $serverName = "localhost";
    private $userName = "root";
    private $passWord = ""; 
    private $dbName = "starlingbagsni";
    protected  $conn;
    private $base_url;
    public function db_connection()
    {

        $this->conn = new mysqli($this->serverName, $this->userName, $this->passWord, $this->dbName);
        if (mysqli_connect_error()) {
            echo "Error:", mysqli_connect_error();
        } else {
            return $this->conn;
        }
    }
    public function query($sql)
    {
        return mysqli_query($this->db_connection(), $sql);
        //return $this->conn->query($sql);
    }
    public function basePath()
    {
        return $this->base_url =  'https://starlingbagsni.co.uk/';
    }
}
