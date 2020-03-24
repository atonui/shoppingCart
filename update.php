<?php
 require './php/component.php';
 require './php/CreateDb.php';
 require 'header.php';

 // create an instance of the database class (CreateDb)
 $database = new CreateDb("productDb","productTable");
 global $name ;
 global $price;
 global $productDescription;
 global $image;
 global $id;

//  get existing data from db and display it on the edit form
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $result = $database->getSpecificData($id);
    while($row = mysqli_fetch_assoc($result)){
        $name = $row['product_name'];
        $price = $row['product_price'];
        $productDescription = $row['description'];
        $image = $row['product_image'];
    }
}

if(isset($_POST['btn_updateProduct'])){
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $description = $_POST['description'];
    if(isset($_POST['productImage'])){ //if user picked a new image
        $productImage = uploadImage('productImage');
        $database->updateData($id, $productName, $productPrice, $description, $productImage);
    }else{ //if user maintained current image
        $database->updateData($id, $productName, $productPrice, $description, $image);
    }
}


// once user clicks the edit button acquire new values using post and update the db
 
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xl-8">
<!--            table-->
            <img src="<?php echo $image?>" class="img-fluid" style="max-width:100%; height:auto;">
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
<!--            form to add product-->
            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="productName" class="form-control" value="<?php echo $name?>">
                    </div>

                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="productPrice" class="form-control" value="<?php echo $price?>">
                    </div>

                    <div class="form-group">
                    <label for="">Description</label>
                        <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $productDescription?></textarea>
                    </div>
                    <label for="">Image</label>
                    <input type="file" name="productImage">
                    <button class="btn btn-info btn-block" name="btn_updateProduct">Update</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php
require 'footer.php';
?>