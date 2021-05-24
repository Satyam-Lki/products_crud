<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <title>Update Product</title>
</head>
<body>
<?php
    try {
        $conn = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } 
      catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
     $id= isset($_GET['id'])?$_GET['id']:null;

    if(isset($id)){
        var_dump($id);
        
          $query = "select * from products_db.products where `prod_id`=:id";
          $stmt = $conn->prepare($query);
          $stmt->bindValue(':id',$id);
    
          $stmt->execute();
          $product = $stmt->fetch(PDO::FETCH_ASSOC);
          echo "Successed";
    }
      //var_dump($product);

    
      ?>
      <?php 
$disabled = (isset($_GET)) ? "": "disabled='disabled'";
var_dump($disabled);

?>
    <?php
    if( $_SERVER['REQUEST_METHOD']==='POST') {
        $prod_name=  $_POST['prod_name'];
        $prod_type=  'SmartPhone';
        $price=      $_POST['price'];
        $description=$_POST['description'];

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



<h1>Enter the Product Specs</h1>
    <form action="edit.php" method="POST" <?php echo $disabled; ?>>
        <div class="mb-3">
            <label for="prod_name" class="form-label">Product Name </label>
            <input type="text" name="prod_name" value=<?php echo $product['prod_name']?> class="form-control" required placeholder="enter the product">
        </div>
        </br>
        <div class="mb-3">
            <label for="prod_type" class="form-label">Product Type </label>
            <select name="prod_type" disabled>
                <option value="SmartPhone">SmartPhone</option>
                <option value="PC">PC</option>
                <option value="Accessories">Accessories</option>
            </select>
        </div>
        </br>
        <div class="mb-3">
            <label for="price" class="form-label">Price </label>
            <input type="number"  name="price" value="<?php echo $product['price'] ?>" class="form-control" required placeholder="upto 2 decimal places">
        </div>
        </br>
        <div class="mb-3">
            <label for="description" class="form-label">Desription </label>
            <textarea name="description"  cols="50" rows="2"><?php echo $product['description'] ?></textarea>
        </div>
        </br>
        <div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
        </div>
    </form>


</body>
</html>