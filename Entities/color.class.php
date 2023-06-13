<?php 
require_once("./config/db.class.php");

class Color
{
    public $colorID;
    public $colorName;

    public function __construct($colorName)
    {
        $this->colorName = $colorName;        
    }

    public static function list_color()
    {
        $db = new Db();
        $sql = "SELECT * FROM color";
        $result = $db->select_to_array($sql);
        return $result;
    }


}
?>