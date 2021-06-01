
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="app.css">
</head>

<body>
<?php
    require_once('connect.php');
// try{
//     $conn = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
// }
// catch(PDOException $e){
//     echo "Connection Failed:". $e->getMessage();
// }


$str=$_GET['str'];
//var_dump($str);
$stmt = $conn->prepare("SELECT * FROM `products` where `prod_name` like :search");
$stmt->bindvalue(':search', "%$str%");
$stmt->execute();
$products=$stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($products);



?>
<a href="../index.php">  <h1>Digital Zone</h1> </a>
</br>
<table class="table">
<thead>
  <tr>
    <th scope="col">PRODUCT ID</th>
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
      <td><?php echo $product['prod_name'] ?></td>
      <td><?php echo $product['prod_type'] ?></td>
      <td><?php echo $product['price'] ?></td>
      <td><?php echo $product['description'] ?></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>


</body>
</html>
