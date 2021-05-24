<?php
$prod_id=$_POST['id'];

try{
$conn = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("DELETE FROM `products` WHERE prod_id=:id");
$stmt->bindvalue(':id', $prod_id);
$stmt->execute();

var_dump($prod_id);
echo "success";
}
catch(PDOException $e){
    echo "Connection Failed:". $e->getMessage();
}

// if($_SERVER['REQUEST_METHOD']==='POST'){
// }
?>
