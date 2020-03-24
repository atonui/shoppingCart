<?php

function component($productName,$productPrice,$productImg,$productId, $description){
    $element = "
        <div class=\"col-md-3 col-sm-6 my-3 my-md-0 \">
                <form action=\"index.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$productImg\" alt=\"tomatoes\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productName</h5>
                            <h6>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"fas fa-star\"></i>
                                <i class=\"far fa-star\"></i>
                            </h6>
                            <p class=\"card-text\">
                                $description
                            </p>
                            <h5>
                                <small><s class=\"text-secondary\">Ksh. 60</s></small>
                                <span class=\"price\">$productPrice</span>
                            </h5>
                            <button type=\"submit\" name=\"add-to-cart\" class=\"btn btn-warning my-3\">Add to Cart <i class=\"fas fa-shopping-cart\"></i> </button>               
                            <!-- here we have associated the product with its id -->
                            <input type=\"hidden\" name='productId' value=\"$productId\">
                        </div>

                    </div>
                </form>
            </div>
    ";
    echo $element;
}

function cartElement($productImg,$productName,$productPrice,$productId){
    $element = "
               <form action=\"cart.php?action=remove&id=$productId\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=\"$productImg\" alt=\"carrots\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productName</h5>
                                <small class=\"text-secondary\">Seller: MIT</small>
                                <h5 class=\"pt2\">$productPrice</h5>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
<!--                                    add functionality with javascript
                                    <button class=\"btn bg-light border rounded-circle\" type=\"button\"><i class=\"fas fa-minus\"></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                    <button class=\"btn bg-light border rounded-circle\" type=\"button\"><i class=\"fas fa-plus\"></i></button>
                                    add functionality with javascript end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    ";

    echo $element;
}

//dashboard component
//add description row to db table and pass it here
function dashboardComponent($productName,$productPrice,$productImg,$productId, $description){
    $element = "
        <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action=\"dashboard.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$productImg\" alt=\"tomatoes\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productName</h5>
                            
                            <p class=\"card-text\">
                            $description
                            </p>
                            <h5>
                                <span class=\"price\">Ksh. $productPrice</span>
                            </h5>
                            <button type=\"submit\" name=\"edit\" class=\"btn btn-warning my-3\">Edit</button>               
                            <button type=\"submit\" name=\"delete\" class=\"btn btn-danger my-3\">Delete</button>               
                            <!-- here we have associated the product with its id -->
                            <input type=\"hidden\" name='productId' value=\"$productId\">
                        </div>

                    </div>
                </form>
            </div>
    ";
    echo $element;
}

function editComponent($productName,$productPrice,$productImg,$productId){
    $element = "
        <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action=\"dashboard.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$productImg\" alt=\"tomatoes\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <input class=\"card-title\" value='$productName'>
                            
                            <p class=\"card-text\">
                                Some information on the product.
                            </p>
                            <h5>
                                <span class=\"price\">$productPrice</span>
                            </h5>
                            <button type=\"submit\" name=\"edit\" class=\"btn btn-warning my-3\">Edit</button>               
                            <button type=\"submit\" name=\"delete\" class=\"btn btn-danger my-3\">Delete</button>               
                            <!-- here we have associated the product with its id -->
                            <input type=\"hidden\" name='productId' value=\"$productId\">
                        </div>

                    </div>
                </form>
            </div>
    ";
    echo $element;
}

function uploadImage($imageInputName){
//product image handling
    // get image file name and extension
    $target_directory = "./upload/";
    $file_name = $_FILES[$imageInputName]['name'];
    $target_file = $target_directory.basename($file_name); //image file name
    $imageFileExtension = pathinfo($file_name, PATHINFO_EXTENSION); //get file extension type
    $imageTemporaryLocation = $_FILES[$imageInputName]['tmp_name']; //temprary location of image file before it is uploaded
    //$fullImageFileName = $target_file.$imageFileExtension; //complete image file name and extension

    //image file validation
    $extension = array("jpeg","jpg","png"); //allowed extensions

    if (in_array($imageFileExtension, $extension) == false){
        //if user uploads an images with a different extension
        echo "
                <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                  <strong>Extension not allowed, please choose JPG, JPEG or PNG file type!
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>
            ";
    }
    if (empty($image_error)){
        //upload images to the images folder
        move_uploaded_file($imageTemporaryLocation,$target_file);
        return $target_file;
    }
}























