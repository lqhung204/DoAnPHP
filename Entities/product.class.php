<?php

require_once("./config/db.class.php");

class product
{
    public $productID;
    public $productName;
    public $colorID;
    public $unit;
    public $price;
    public $available;
    public $productPicture;
    public $typeproduct_id;
    
    
    public function __construct($productName, $colorID, $unit, $price, $available, $productPicture, $typeproduct_id)
    {
        $this->productName = $productName;
        $this->colorID = $colorID;
        $this->unit = $unit;
        $this->price = $price;
        $this->available = $available;
        $this->productPicture = $productPicture;
        $this->typeproduct_id = $typeproduct_id;

    }
  
    public function save()
    {
        $filetemp = $this->productPicture['tmp_name'];
        $user_file = $this->productPicture['name'];
        $timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
        $filepath = "uploads/".$timestamp.$user_file;
        if(move_uploaded_file($filetemp, $filepath)==false){
            return false;
        }

        $db = new Db();

        $sql = "INSERT INTO product (productName, colorID, unit, price, available, productPicture, typeproduct_id) VALUE
        ('$this->productName', '$this->colorID', '$this->unit', '$this->price', '$this->available', '$filepath', '$this->typeproduct_id')";
        echo $sql;
        $result = $db->query_execute($sql);
       
        
        return $result;
    }

    public static function list_product()
    {
        $db = new Db();
        $sql = "SELECT * FROM product";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function list_product_by_cateid($colorID){
        $db = new Db();
        $sql = "SELECT * FROM product WHERE colorID='$colorID'";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function list_product_by_typeproduct($typeproduct_id){
        $db = new Db();
        $sql = "SELECT * FROM product WHERE typeproduct_id='$typeproduct_id'";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function list_product_relate($typeproduct_id, $id){
        $db = new Db();
        $sql = "SELECT * FROM product WHERE typeproduct_id='$typeproduct_id' AND product_id !='$id'";
        $result = $db->select_to_array($sql);
        return $result;
    }

     public static function get_product($id)
     {
         $db = new Db();
         $sql = "SELECT * FROM product WHERE product_id='$id'";
         $result = $db->select_to_array($sql);
         return $result;
     }

     public function update()
    {
        $filetemp = $this->productPicture['tmp_name'];
        $user_file = $this->productPicture['name'];
        $timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
        $filepath = "uploads/".$timestamp.$user_file;
        if(move_uploaded_file($filetemp, $filepath)==false){
            return false;
        }
  
        $db = new Db();

        $sql = "UPDATE product SET productName='$this->productName',colorID='$this->colorID',unit='$this->unit',price='$this->price'
        ,available='$this->available',productPicture='$filepath',typeproduct_id='$this->typeproduct_id')";

        echo $sql;
        $result = $db->query_execute($sql);
       
        
        return $result;
    }
}

?>