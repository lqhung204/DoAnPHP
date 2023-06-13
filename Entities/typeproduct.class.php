<?php 

require_once("./config/db.class.php");

class Typeproduct
{
    public $typeproductID;
    public $typeName;

    public function __construct($typeName)
    {
        $this->typeName = $typeName;        
    }
   
    public function save(){
        $db = new Db();
        $sql = "INSERT INTO typeofproduct(typeName) VALUES ('$this->typeName')";
        $result = $db->query_execute($sql);
        return $result;

    }
    
    public static function list_typeproduct()
    {
        $db = new Db();
        $sql = "SELECT * FROM typeofproduct";
        $result = $db->select_to_array($sql);
        return $result;
    }
    
}
?>