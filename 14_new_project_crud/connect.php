<?php
function con(){
    try{
        $conn = new PDO('mysql:host=localhost;port=3306;dbname=products_db', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }
    catch(PDOException $e){
        echo "Connection Failed:". $e->getMessage();
    }
}
?>