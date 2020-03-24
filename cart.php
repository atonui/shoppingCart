
<body class="bg-light">
<?php
session_start();
require 'php/CreateDb.php';
require 'header.php';
require 'php/component.php';

$db = new CreateDb("productDb", "productTable");

if (isset($_POST['remove'])){
    if($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if ($value['productId'] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "
                <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                  <strong>Product has been removed!
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>
            ";
            }
        }
    }
}
?>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h6>My Cart</h6>
                <hr>
                <?php
                    $total = 0;
                    if (isset($_SESSION['cart'])){
                        $productId = array_column($_SESSION['cart'],'productId');
                        $result = $db->getData();
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($productId as $id){
                                if ($row['id'] == $id){
                                    cartElement($row['product_image'],$row['product_name'],$row['product_price'],$row['id']);
                                    $total = $total + (int)$row['product_price'];
                                }
                            }
                        }
                    }else{
                        echo "<h5>No items in cart</h5>";
                    }
                ?>
            </div>
        </div>
        <div class="col-md-5">
            <div class="pt-4 offset-md-1 border rounded mt-5 bg-white h-45">
                <h5>PRICE DETAILS</h5>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>Ksh. <?php echo $total;?></h6>
                        <h6 class="text-success">Free</h6>
                        <hr>
                        <h6>Ksh. <?php echo $total;?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'footer.php';
