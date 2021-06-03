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
    <a href="index.php">
        <h1>Digital Zone</h1>
    </a>
    <br>
    <h1>Enter the Product Specs</h1>
    <form action="create.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="image">Upload Image</label>
            <input type="file" name="image">
        </div>
        </br>
        <div class="mb-3">
            <label for="prod_name" class="form-label">Product Name </label>
            <input type="text" name="prod_name" class="form-control" required placeholder="enter the product">
        </div>
        </br>
        <div class="mb-3">
            <label for="prod_type" class="form-label">Product Type </label>
            <select name="prod_type">
                <option value="SmartPhone">SmartPhone</option>
                <option value="PC">PC</option>
                <option value="Accessories">Accessories</option>
            </select>
        </div>
        </br>
        <div class="mb-3">
            <label for="price" class="form-label">Price </label>
            <input type="number" name="price" class="form-control" required placeholder="upto 2 decimal places">
        </div>
        </br>
        <div class="mb-3">
            <label for="description" class="form-label">Desription </label>
            <textarea name="description" cols="50" rows="2"></textarea>
        </div>
        </br>
        <div>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>

    <?php
    //var_dump($_SERVER['REQUEST_METHOD']);
    require_once('connect.php');
    // try {
    //     $conn = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //var_dump($_SERVER);    
        $prod_name = $_POST['prod_name'];
        $prod_type = $_POST['prod_type'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        //$prod_img = $_POST['image'];

        //to upload data in products table 
        $stmt = $conn->prepare("INSERT  INTO products (prod_name, prod_type, price, description) VALUES (:product,:type,:price,:description)");
        $stmt->bindvalue(':product', $prod_name);
        $stmt->bindvalue(':type', $prod_type);
        $stmt->bindvalue(':price', $price);
        $stmt->bindvalue(':description', $description);
        $stmt->execute();
        $id=$conn->lastInsertId();

        //to upload the image
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".".'</br>';
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        if($uploadOk==1){
            $stmt2 = $conn->prepare("INSERT  INTO images (img_path, prod_id) VALUES (:img,:id)");
            $stmt2->bindvalue(':img', $_FILES["image"]["name"]);
            $stmt2->bindvalue(':id', $id);
            $stmt2->execute();
            echo "Image uploaded";
    

        }
    }

    //echo "Connected successfully";
    //$products = $statement->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($products);
    // } catch (PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    // }



    ?>
</body>

</html>