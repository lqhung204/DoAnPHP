<?php 

class Db
{
    protected static $connection;
   
    public function connect()
    {
        $username = "root";
        $password = "";
        $databasename = "shopquanao";
        $server = "localhost";
       
        if (!isset(self::$connection)) {
            
            $config = parse_ini_file("config.ini");
            self::$connection = new mysqli("localhost", $config["username"], $config["password"], $config["databasename"]);       
            
           
        }
        
        if(self::$connection == false) {
            echo "kết nối không thành công";
            return false;
        }
        return self::$connection;
    }

    public function query_execute($queryString)
    {
     
        $connection = $this->connect();
       
        $result = $connection->query($queryString);
        
        return $result;
    }
  
    public function select_to_array($queryString)
    {
        $rows = array();
        $result = $this->query_execute($queryString);
        if ($result == false) {
            return false;
        }
        while ($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }
        return $rows;
    }
}
?>
