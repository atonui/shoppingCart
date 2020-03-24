<?php

//start a session
session_start();

//allow only adminnistrators to see this page. Maybe use sessions?

require './php/component.php';
require './php/CreateDb.php';

//create instance of CreateDb class
$database = new CreateDb("productDb","productTable");

if (isset($_POST['edit'])){
    $id = $_POST['productId'];
    header("location:update.php?id=$id"); //pass product id through GET global variable

}

if (isset($_POST['delete'])){
    $database->deleteData($_POST['productId']);

}

require 'header.php'
?>
<body>
<button class="btn btn-info btn-block" name="add_product">Add Product</button>
<div class="container">
    <div class="row text-center py-5">
        <?php
        $result = $database->getData();
        while ($row = mysqli_fetch_assoc($result)){
            dashboardComponent($row['product_name'],$row['product_price'],$row['product_image'],$row['id'], $row['description']);
        }
        ?>
    </div>

</div>

<?php
require 'footer.php';
?>


















