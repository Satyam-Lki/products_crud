<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digital Zone</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="app.css">
  <!-- <style>
  .image{
    border: 10px;
    color: #fff;
  }
</style> -->
</head>

<body>
  <?php
  require_once('connect.php');

  // try {
  //   $conn = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "select `p`.`prod_id` ,`prod_name`,`prod_type`,`price`,
    `description`,`img_path`
     from `products` p LEFT JOIN `images` i ON p.prod_id=i.prod_id";
    $statement = $conn->prepare($query);
    $statement->execute();
    //echo "Connected successfully";
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($products);
  // } catch (PDOException $e) {
  //   echo "Connection failed: " . $e->getMessage();
  // }



  ?>
  <h1 style="color: #000; font-family: Verdana, Geneva, Tahoma, sans-serif; border: 0.2rem outset grey; background-color:#92a8d1;">Digital Zone</h1>
  <form action="search.php/?str" method="GET">
  <div class="input-group mb-3">
  <input type="text" class="form-control" name="str" placeholder="Enter the product" aria-describedby="basic-addon2" style="border: 0.5rem outset pink; padding :0.5rem;">
  <span class="input-group-text" id="basic-addon2"><input type="submit" class="btn btn-sm btn-primary" value="Search"></input></span>
</div>
  </form>
</br>
  <div>
    <a href="create.php"><button type="button" class="btn btn-success" >Create Product</button></a>
  </div>
  </br>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">PRODUCT ID</th>
        <th scope="col">PRODUCT IMAGE</th>
        <th scope="col">PRODUCT</th>
        <th scope="col">CATEGORY</th>
        <th scope="col">PRICE</th>
        <th scope="col">DESCRIPTION</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) : ?>
        <tr>
          <td><?php echo $product['prod_id'] ?></td>
          <td>
          <img src="uploads/<?php echo $product['img_path'] ?>" alt="No Image Uploaded" height="100px" width="100px" style="border: 0.2rem solid rgba(170, 50, 220, .6); padding: 10px;">
          </td>
          <td><?php echo $product['prod_name'] ?></td>
          <td><?php echo $product['prod_type'] ?></td>
          <td><?php echo $product['price'] ?></td>
          <td><?php echo $product['description'] ?></td>
          <td>
          <form action="edit.php/?id" method="GET" style="display: inline-block;">
          <div>
          <input type="hidden" name="id" class="form-control" value="<?php echo $product['prod_id'] ?>">
          <button type="submit" class="btn btn-sm btn-primary">Edit</button></div>
          </form>

          <form action="delete.php" method="POST" style="display: inline-block;">
          <div>
          <input type="hidden" name="id" class="form-control" value="<?php echo $product['prod_id'] ?>">
          <button type="submit" class="btn btn-sm btn-danger">Delete</button></div>
          </form>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>

</body>

</html>