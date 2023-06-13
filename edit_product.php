<?php
require_once("./Entities/product.class.php");
require_once("./Entities/color.class.php");
require_once("./Entities/typeproduct.class.php");

if (isset($_POST["btnsubmit"])) {
    include_once("./header.php");
if (!isset($_GET["id"])) {
    header('Location: not_found.php');
} else {
    $id = $_GET["id"];
    $product = reset(product::get_product($id));
    $product_relate = product::list_product_relate($product["typeproduct_id"], $id);
}
$typeproduct = Typeproduct::list_typeproduct();
    
    $productName = $_POST["txtName"];
    $colorID = $_POST["txtColorID"];
    $unit = $_POST["txtUnit"];
    $price = $_POST["txtPricce"];
    $available = $_POST["txtAvailable"];
    $productPicture = $_FILES["txtpic"];
    $typeproductID = $_POST["txttypeproductID"];
    
    
    $newproduct = new product($productName, $colorID, $unit, $price, $available, $productPicture, $typeproductID);
    

    $result = $newproduct->save();

    if (!$result) {
        header("Location: add_product.php?failure");
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





<!-- form sản phẩm -->
<form method="post" enctype="multipart/form-data">
    <!-- productname -->
    <div class="row">
        <div class="lbltitle">
            <label>Tên Sản Phẩm</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtName" value="
                                                <?php echo $product["productName"]; 
                                                echo isset($_POST["txtName"]) ? $_POST["txtName"] : ""; ?>" />
        </div>
    </div>
    <!-- cateid product -->
    <div class="row">
        <div class="lbltitle">
            <label>Màu Sản Phẩm</label>
        </div>
        <div class="lblinput">
            <select name="txtColorID" style="width: 200px;">
                <option value="" selected>--Chọn Màu--</option>
                <?php
                $color = Color::list_color();
                foreach ($color as $item) {
                    echo "<option value=" . $item["color_id"] . ">" . $item["colorName"] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <!-- unit product -->
    <div class="row">
        <div class="lbltitle">
            <label>Số lượng sản phẩm</label>
        </div>
        <div class="lblinput">
            <input type="number" name="txtUnit" value="
                                                    <?php
                                                    echo isset($_POST["txtUnit"]) ? $_POST["txtUnit"] : ""; ?>" />
        </div>
    </div>
    <!-- product price -->
    <div class="row">
        <div class="lbltitle">
            <label>Giá bán</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtPricce" value="
                                                    <?php
                                                    echo isset($_POST["txtPricce"]) ? $_POST["txtPricce"] : ""; ?>" />
        </div>
    </div>
    <!-- cate product -->
    <div class="row">
        <div class="lbltitle">
            <label>Số lượng tồn </label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtAvailable" value="
                                                    <?php
                                                    echo isset($_POST["txtAvailable"]) ? $_POST["txtAvailable"] : ""; ?>" />
        </div>

    </div>
    <!-- type flower -->
    <div class="row">
        <div class="lbltitle">
            <label>Chọn loại sản phẩm </label>
        </div>
        <div class="lblinput">
            <select name="txttypeproductID" style="width: 200px;">
                <option value="" selected>--Chọn loại sản phẩm--</option>
                <?php
                $type = $Typeproduct::list_typeproduct();
                foreach ($type as $item) {
                    echo "<option value=" . $item["typeproduct_id"] . ">" . $item["typeName"] . "</option>";
                }
                ?>
            </select>
        </div>

    </div>
    <!-- picture -->
    <div class="row">
        <div class="lbltitle">
            <label>Thêm hình ảnh</label>
        </div>
        <div class="lblinput">
            <input type="file" id="txtpic" name="txtpic" accept=".PNG, .GIF, .JPG">
            <!-- <input type="text" name="txtpic" value="<?php echo isset($_POST["txtpic"]) ? $_POST["txtpic"] : ""; ?>"> -->

        </div>
    </div>
    <!-- btn thêm -->
    <div class="row">
        <div class="submit">
            <input type="submit" name="btnsubmit" value="Thêm sản phẩm" style="margin-top: 20px;" />
        </div>
    </div>
</form>
<?php include_once("footer.php"); ?>