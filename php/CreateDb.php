<?php

class CreateDb
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $conn;


    //class constructor
    public function __construct(
        $dbname = "Newdb",
        $tablename = "Productdb",
        $servername = "localhost",
        $username = "root",
        $password = ""
    )
    {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->password = $password;
        $this->username = $username;
        $this->servername = $servername;

        //create db connection
        $this->conn = mysqli_connect($servername,$username,$password);

        //check connection

        if (!$this->conn){
            die("Connection failed:".mysqli_error($this->conn));
        }

        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        if (mysqli_query($this->conn,$sql)){
            $this->conn = mysqli_connect($servername,$username,$password,$dbname);

            //sql to create new table

            $sql = "CREATE TABLE IF NOT EXISTS $tablename
                    (id INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    product_name VARCHAR(32) NOT NULL ,
                    product_price FLOAT,
                    description VARCHAR(255),
                    product_image VARCHAR(100))";
            if (!mysqli_query($this->conn,$sql)){
                echo "Error creating table: ".mysqli_error($this->conn);
            }
        }else
            return false;

    }

    //get product from database

    public function getData(){
        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->conn,$sql);

        if (mysqli_num_rows($result) > 0){
            return $result;
        }
    }

    //get specific record using ID

    public function getSpecificData($id){
        $sql = "SELECT `product_name`, `product_price`, `description`, `product_image` FROM $this->tablename WHERE id='$id'";
        $result = mysqli_query($this->conn,$sql);

        if (mysqli_num_rows($result) > 0){
            return $result;
        }
    }

    // delete product from database

    public function deleteData($id){
        $sql = "DELETE FROM $this->tablename WHERE id='$id'";
        if (!mysqli_query($this->conn,$sql)){
            echo mysqli_error($this->conn);
        }
    }

    // insert data into the database

    public function insertData($productName, $productPrice, $description, $productImage){
        $sql = "INSERT INTO $this->tablename (`id`, `product_name`, `product_price`, `description`, `product_image`) VALUES (NULL, '$productName', '$productPrice', '$description', '$productImage')";
        if (!mysqli_query($this->conn,$sql)){
            echo mysqli_error($this->conn);
        }else{
            echo "
                <div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\">
                  <strong>Product had been added to the database.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>
            ";
        }
    }

    public function updateData($id, $productName, $productPrice, $description, $productImage){
        $sql = "UPDATE $this->tablename SET `product_name`= '$productName',`product_price`='$productPrice',`description`='$description',`product_image`='$productImage' WHERE id='$id'";
        if(mysqli_query($this->conn, $sql)){
            echo "
                <div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\">
                  <strong>Product had been updated in the database.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>
            ";
        }else{
            echo mysqli_error($this->conn);
        }
    }

}


