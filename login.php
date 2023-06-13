<?php include_once('./header.php'); ?>
<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if (isset($_SESSION["user"]) != "") {
    //header("Location: list_product.php");
}

require_once("./Entities/user.class.php");

if (isset($_POST['btn-login'])) {
    $u_name = $_POST['txtname'];
    $u_pass = md5($_POST['txtpass']);
    $account = User::checkLogin($u_name, $u_pass);   
    if (!$account) { 
        echo "<script> alert('Có lỗi xảy ra, vui lòng kiểm tra lại!')</script>";
    } else {
        
        $_SESSION['user'] = $u_name;
        //header("Location: list_product.php");
    }
}
?>
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Login to your account</h2>
                    <form method="POST">
                        <input type="text" placeholder="UserName" name="txtname" />
                        <input type="password" placeholder="Password" name="txtpass" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span>
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" name="btn-login" value="Login">
                        </div>
                    </form>
                </div>
                <!--/login form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->

<?php include_once('./footer.php'); ?>
