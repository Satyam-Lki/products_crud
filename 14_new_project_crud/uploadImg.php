<?php
    require_once 'connect.php';
    session_start();

    //to upload the image
    function upload($id, $image, $conn ){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($image["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".".'</br>';
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($image["image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($image["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        //execute a query to check whether an id exist in image or not
        // $query2="select exists(select * from images where `prod_id`=:id)";
        // $stmt2=$conn->prepare($query2);
        // $stmt2->bindValue(':id',$id);

        // $stmt2->execute();
        // $var=    $stmt2->fetchAll(PDO::FETCH_ASSOC);
        // //extract($var_array, EXTR_PREFIX_SAME,"flag");
        // //var_dump($var);
        // $flag= $var[0];
        // var_dump($flag);
        $check=$_SESSION['flag'];

        if($uploadOk==1 ){
            if(!$check){
                $stmt2 = $conn->prepare("INSERT  INTO images (img_path, prod_id) VALUES (:img,:id)");
                $stmt2->bindvalue(':img', $image["image"]["name"]);
                $stmt2->bindvalue(':id', $id);
                $stmt2->execute();
                echo "Image uploaded";
        
    
            }
            else{
                    $stmt2 = $conn->prepare("UPDATE images set `img_path`=:img where `prod_id`=:id AND `prod_id`");
                    $stmt2->bindvalue(':img', $image["image"]["name"]);
                    $stmt2->bindvalue(':id', $id);
                    $stmt2->execute();
                    echo "Image edited";
            }



    }
}
    // destroy the session
    //unset($_SESSION['flag']);


    ?>
