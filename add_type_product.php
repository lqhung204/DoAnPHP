<?php
require_once("./Entities/product.class.php");
require_once("./Entities/color.class.php");
require_once("./Entities/typeproduct.class.php");

if (isset($_POST["btnsubmit"])) {
    
    $typeName = $_POST["txtName"];    
   
    $newtypeproduct = new Typeproduct($typeName);
    

    $result = $newtypeproduct->save();

    if (!$result) {
        header("Location: add_type_product.php?failure");
        echo "Thất bại";
    } else {
        header("Location: list_product.php?inserted");
    }
}

?>
<?php include_once("header.php"); ?>

<?php

if (isset($_GET["inserted"])) {
    echo "<h2>Thêm sản phẩm thành công</h2>";
}
?>






<form method="post">
   
    <div class="row">
        <div class="lbltitle">
            <label>Tên Loại</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtName" value="
                                                <?php
                                                echo isset($_POST["txtName"]) ? $_POST["txtName"] : ""; ?>" />
        </div>
    </div>   
    
    <div class="row">
        <div class="submit">
            <input type="submit" name="btnsubmit" value="Thêm loại" style="margin-top: 20px;" />
        </div>
    </div>
</form>
<?php include_once("footer.php"); ?>