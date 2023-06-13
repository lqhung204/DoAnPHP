<?php
require_once("./Entities/product.class.php");
require_once("./Entities/color.class.php");
require_once("./Entities/typeproduct.class.php");

?>

<?php
include_once("./header.php");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if (!isset($_GET["typeproduct_id"])) {
    $products = product::list_product();
} else {
    $typeproduct = $_GET["typeproduct_id"];
    $products = product::list_product_by_typeproduct($typeproduct);
}

$typeproducts = Typeproduct::list_typeproduct();
?>
<div class="col-sm-3">
    <h3>Danh sách Loại</h3>
    <ul class="list-group">
        <?php
        foreach($typeproducts as $item){
            echo"<li class = 'list-group-item'><a
            href=/DoAnMaNguonMo/list_product.php?typeproduct_id=".$item["typeproduct_id"].">".$item["typeName"]."</a></li>";
        }?>
    </ul>
</div>
<div class="container text-center">
    <h3>Danh sách sản phẩm cửa hàng</h3><br />
    <div class="row">
        <?php
        
        foreach ($products as $item) {
        ?>
            <div class="col-sm-4">
               <a href="./product_detail.php?id=<?=$item['product_id']?>"> <img src="<?php echo "../DoAnMaNguonMo/" . $item["productPicture"]; ?>" class="img-responsive" style="width: 100%;" alt="Image"></a>
                <p class="text-danger"><?php echo $item["productName"]; ?></p>
                <p class="text-info"><?php echo number_format($item["price"], 0, ",", ".") ?> VND</p>
                <p>
                    <!-- <button type="button" class="btn btn-primary" onclick="location.href='../DA_manguonmo/shopping_flow.php?id=<?php echo $item["product_id"]; ?> '">Mua Hoa </button> -->
                </p>
            </div>
        <?php } ?>
    </div>

</div>
<?php include_once("./footer.php"); ?>