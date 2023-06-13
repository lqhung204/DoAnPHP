<?php 

require_once("./config/db.class.php");

class User
{
    public $userID;
    public $userName;
    public $email;
    public $password;
    
    
    public function __construct($userName, $email, $password)
    {
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }
    
    public function save()
    {
        $db = new Db();
        
        $sql = "INSERT INTO user (userName, email, password) VALUES ('".mysqli_real_escape_string($db->connect(),
        $this->userName)."', '".mysqli_real_escape_string($db->connect(),
        $this->email)."','".md5(mysqli_real_escape_string($db->connect(), $this->password))."')"; 
        $result = $db->query_execute($sql);
       
        return $result;
    }
    public static function checkLogin($userName, $password){
        $password = md5($password);
        $db = new Db();
        $sql = "SELECT * FROM user where userName='$userName' AND password='$password'";
        
        $result = $db->query_execute($sql);

        return $result;
    }
}