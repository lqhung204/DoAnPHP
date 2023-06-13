
<?php
require_once("./Entities/product.class.php");
require_once("./Entities/typeproduct.class.php");
?>

<?php
include_once("./header.php");
if (!isset($_GET["id"])) {
    header('Location: not_found.php');
} else {
    $id = $_GET["id"];
    $product = reset(product::get_product($id));
    $product_relate = product::list_product_relate($product["typeproduct_id"], $id);
}
$typeproduct = Typeproduct::list_typeproduct();
?>

<div class="container text-center">
    <div class="col-sm-3 panel panel-danger">
        <h3 class="panel-heading">Loại Sản Phẩm </h3>
        <ul class="list-group">
            <?php
            foreach ($typeproduct as $item) {
                echo "<li class='list-group-item'><a
                href=/DoAnMaNguonMo/list_product.php?typeproduct_id=" . $item["typeproduct_id"] . ">" . $item["typeName"] . "</a></li>";
            } ?>
        </ul>
    </div>

    <div class="col-sm-9 panel panel-info">
        <h3 class="panel-heading">Chi tiếT Sản Phẩm</h3>
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo "../DoAnMaNguonMo/" . $product["productPicture"]; ?>" class="img-responsive" style="width:100%" alt="Image">
            </div>
            <div class="col-sm-6">
                
                <div style="padding-left:10px">
                    <h3 class="text-info">
                        <?php echo $product["productName"]; ?>
                    </h3>                   
                    <p>
                        Giá: <?php echo number_format($product["price"], 0, ",", ".") ?> VND
                    </p>                 
                    
                    <p>
                    <a href="./shopping_prod.php?id=<?=$product['product_id']?>">  <button type="button" class="btn  btn-danger">Mua Hàng</button> </a>
                    </p>
                </div>
            </div>
        </div>
        <h3 class="panel-heading"> Sản phẩm liên quan</h3>
        <div class="row">
            <?php
            foreach ($product_relate as $item) {
            ?>
                <div class="col-sm-4">
                    <a href="../DoAnMaNguonMo/productr_detail.php?id=<?php echo $item["typeproduct_id"]; ?>">
                        <img src="<?php echo "../DoAnMaNguonMo/" . $item["productPicture"]; ?>" class="img-responsive" style="width:100%" alt="Image">
                    </a>
                    <p class="text-danger"><?php echo $item["productName"]; ?> </p>
                    <p class="text-ingo"><?php echo number_format($item["price"], 0, ",", ".") ?> VND</p>
                    <p>
                        <a href="./shopping_flow.php?id=<?=$item['product_id']?>">  <button type="button" class="btn  btn-danger">Mua Hàng</button> </a>
                    </p>
                </div>
            <?php   } ?>
        </div>
    </div>
</div>
