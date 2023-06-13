<?php include_once('./header.php') ?>
<?php
require_once("./Entities/product.class.php");
require_once("./Entities/typeproduct.class.php");

$typeproduct = Typeproduct::list_typeproduct();

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

error_reporting(E_ALL);
ini_set('disphay_errors','1');

if(isset($_GET["id"])){
    $pro_id = $_GET["id"];
    
    $was_found = false;
    $i=0;
    
    if(!isset($_SESSION["cart_items"]) || count($_SESSION["cart_items"])<1){
        $_SESSION["cart_items"] = array(0=> array("pro_id"=>$pro_id,"unit"=>1));
    }
    else{
       
        foreach($_SESSION["cart_items"] as $item){
            $i++;
           
            foreach($item as $key=>$value){
                if($key == "pro_id" && $value == $pro_id){
                    
                    array_splice($_SESSION["cart_items"],$i-1,1,array(array("pro_id"=> $pro_id,"unit"=>
                    $item["unit"]+1)));
                    $was_found = true;
                }
            }
        }
    if($was_found == false){
        array_push($_SESSION["cart_items"], array("pro_id"=> $pro_id,"unit"=>1));

    }
}


}
?>

<!-- thong tin trong shopping cart-->
<div class ="container text-center">
    <div class="col-sm-3">
        <h3>Danh mục</h3>
        <ul class = "list-group">
        <?php
            foreach ($typeproduct as $item) {
                echo "<li class='list-group-item'><a
                href=/DoAnMaNguonMo/list_product.php?typeproduct_id=" . $item["typeproduct_id"] . ">" . $item["typeName"] . "</a></li>";
            } ?>
        </ul>   
    </div>
    <div class="col-sm-9">
        <h3>Thông tin giỏ hàng</h3> <br>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
               <?php 
               $total_monney =0;
               if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"])>0){
                   foreach($_SESSION["cart_items"] as $item){
                       $id = $item["pro_id"];             
                       $product = product::get_product($id);
                       $prod = reset($product);
                       $total_monney += $item["unit"]*$prod["price"];
                       echo "<tr><td>".$prod["producttName"]."</td><td><img style='width:90px; height:80px' src=".$prod["productPicture"]."
                       /></td><td>".$item["unit"]."</td><td>".number_format($prod["price"],0, ",", ".")."</td><td>".number_format($prod["price"],0, ",", ".")."</td></tr>";

                   }
                        echo "<tr> <td colspan=5><p clas='text-right text-danger'>Tổng tiền: ".number_format($total_monney,0, ",", ".")."</p></td> </tr>";
                        echo "<tr> 
                        <td colspan=3>
                        <p clas='text-right'>
                        <a href='./list_product.php'><button type='button' class'btn btn-primary'>Tiếp tục mua
                        hàng</button></a>
                        </p>
                        </td>
                        <td colspan=2>
                        <p class= 'text-right'><button type='button' class='btn btn-success'>Thanh 
                        toán
                        </button>
                        </p>
                        </td>
                        </tr>";
                    
                   }
                   else{
                       echo "Không có sản phẩm nào trong giỏ hàng!";
                   }
                   
               ?>
            </tbody>
        </table>
    </div>
</div>

<!-- hien thi shopping cart-->
<?php include_once('footer.php'); ?>
