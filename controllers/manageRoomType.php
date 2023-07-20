<?php
    include_once ("../config/dbconnect.php");

    if(isset($_GET['save'])){

        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
    
        $sql="INSERT INTO `room_type`(`room_type_id`, `room_type_name`, `price`) VALUES ('$id', '$name', '$price')";

    }else if(isset($_GET['edit'])){

        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
    
        $sql="UPDATE `room_type` SET `room_type_name`='$name', `price`='$price' WHERE `room_type_id`='$id'";

    }else if (isset($_GET['del'])){
        
        $id = $_POST['id'];

        $sql="DELETE FROM `room_type` WHERE `room_type_id`='$id'";
    }
    
    $result=mysqli_query($conn, $sql);

    if ($result){
        echo "success";
        exit();
    }else{
        echo mysqli_error($conn);
        exit();
    }
?>