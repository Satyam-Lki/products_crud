<?php
// Start the session
session_start();
?>
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
    require_once('connect.php');
    // try {
    //     $conn = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //   }
    //   catch (PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    //   }
     $id= isset($_GET['id'])?$_GET['id']:null;

    if(isset($id)){
        //var_dump($id);

          $query = "select * from products_db.products where `prod_id`=:id";
          $stmt = $conn->prepare($query);
          $stmt->bindValue(':id',$id);

          $stmt->execute();
          $product = $stmt->fetch(PDO::FETCH_ASSOC);

          //fetch the image from the server
          $query2="select * from images where `prod_id`=:id";
          $stmt2=$conn->prepare($query2);
          $stmt2->bindValue(':id',$id);

          $stmt2->execute();
          $img=$stmt2->fetch(PDO::FETCH_ASSOC);
          //var_dump($img);
           $fg=isset($img['img_id']);
        //   var_dump($fg);
          $_SESSION["flag"] = $fg;



    }
      //var_dump($product);


      ?>
      <?php
// $disabled = (isset($_GET)) ? "": "disabled='disabled'";
// var_dump($disabled);

?>



<a href="../index.php">  <h1>Digital Zone</h1> </a>
<h2>Enter the Product Specs</h2>
    <form action="../update.php/?id" method="POST" enctype="multipart/form-data" >

        </br>
        <div>
            <label for="image">Product image</label>
            <img src="../uploads/<?php echo $img['img_path'] ?>" alt="No Image Uploaded" height="100px" width="100px">
            </br>
            <input type="file" name="image" value="<?php echo $img['img_path'] ?>">
        </div>
        </br>
        <div class="mb-3">
            <label for="prod_name" class="form-label">Product Name </label>
            <input type="text" name="prod_name" value="<?php echo $product['prod_name'] ?>" class="form-control" required placeholder="enter the product">
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
            <textarea name="description"  cols="50" rows="2"  > <?php echo $product['description'] ?></textarea>
        </div>
        </br>
        <div>
            <input type="hidden" name="id"  value="<?php echo $product['prod_id'] ?>">
            <button type="submit" name="update" class="btn btn-success">Update</button>
        </div>
    </form>


</body>
</html>