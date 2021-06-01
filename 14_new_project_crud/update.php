<?php
    require_once('connect.php');
//  try {
//     $conn = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   }
//   catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
//   }

    if( $_SERVER['REQUEST_METHOD']==='POST') {
        $prod_name=  $_POST['prod_name'];
        $prod_type=  'SmartPhone';
        $price=      $_POST['price'];
        $description=$_POST['description'];
        $id= $_POST['id'];
        var_dump($id);

        $stmt = $conn->prepare("UPDATE products SET prod_name = :product, prod_type= :type, price= :price, description= :description WHERE prod_id = :id");
        $stmt->bindvalue(':product',$prod_name);
        $stmt->bindvalue(':type',$prod_type);
        $stmt->bindvalue(':price',$price);
        $stmt->bindvalue(':description',$description);
        $stmt->bindvalue(':id',$id);
        $edit=$stmt->execute();
        if(isset($edit)){
            echo "Successfully updated";
        }
    }
?>