<?php

//start a session
session_start();

require './php/component.php';
require './php/CreateDb.php';

//create instance of CreateDb class
$database = new CreateDb("productDb","productTable");

if (isset($_POST['add-to-cart'])){
    if (isset($_SESSION['cart'])){
        //print_r($_SESSION['cart']);
        $item_array_id = array_column($_SESSION['cart'],"productId");
       // print_r($item_array_id);

        if (in_array($_POST['productId'],$item_array_id)){
            echo "
                <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                  <strong>Product is already added to cart!
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>
            ";
        }else{
            $count = count($_SESSION['cart']);
            $item_array = array(
                'productId'=>$_POST['productId']
            );
            $_SESSION['cart'][$count] = $item_array;
        }

    }else{
        $item_array = array(
                'productId'=>$_POST['productId']
        );

        //create new session variable
        $_SESSION['cart'][0] = $item_array;
        //print_r($_SESSION['cart']);
    }
}
require 'header.php'
?>
    <body>
        <div class="container">
            <div class="row text-center py-5">
                <?php
                $result = $database->getData();
                while ($row = mysqli_fetch_assoc($result)){
                    component($row['product_name'],$row['product_price'],$row['product_image'],$row['id'],$row['description']);
                }
                ?>
            </div>

        </div>

<?php
require 'footer.php';
?>