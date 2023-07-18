<?php

class Database
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $db;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    function connect()
    {
        $this->db = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    function close()
    {
        $this->db->close();
    }

    function query($sql)
    {
        $result = $this->db->query($sql);

        if (!$result) {
            echo "QUERY ERROR: " . $this->db->error;
            return false;
        }

        return $result;
    }
}
