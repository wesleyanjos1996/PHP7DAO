<?php

class SQL extends PDO
{
    private $connection;

    public function __construct(){$this->connection = new PDO("mysql:host=127.0.0.1;dbname=dbphp7", "wesleyanjos", "wda22SQL@my&");}

    private function setParams($statment, $parameters = array())
    {
        foreach($parameters as $key => $value)
        {$this->setParam($key, $value);}
    }

    private function setParam($statment, $key, $value){$statment->bindParam($key, $value);}

    public function setQuery($rawQuery, $params = array())
    {
        $stmt = $this->connection->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->setQuery($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>