<?php
 require './php/component.php';
 require './php/CreateDb.php';
 require 'header.php';

 $image_error = "";

 // create an instance of the database class (CreateDb)
 $database = new CreateDb("productDb","productTable");

 if (isset($_POST['btn_addProduct'])){
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $description = $_POST['description'];
    
    $target_file = uploadImage("productImage");
    $database->insertData($productName, $productPrice, $description, $target_file);
 }
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xl-8">
<!--            table-->
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
<!--            form to add product-->
            <form action="add_product.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="productName" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="productPrice" class="form-control" required>
                    </div>

                    <div class="form-group">
                    <label for="">Description</label>
                        <textarea name="description" class="form-control" cols="30" rows="10" required></textarea>
                    </div>
                    <label for="">Image</label>
                    <input type="file" name="productImage" required>
                    <button class="btn btn-info btn-block" name="btn_addProduct">Add Product</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php
require 'footer.php';
?>