<?php
    include_once ("../config/dbconnect.php");

    if(isset($_GET['new'])){

        $room_id = uniqid("r");
        $room_name = $_POST['roomName'];
        $room_type_id = $_POST['roomType'];
    
        $sql="INSERT INTO `room`(`room_id`, `room_name`, `room_type_id`, `room_status`) VALUES ('$room_id', '$room_name', '$room_type_id', 'Free')";

    }else if(isset($_GET['edit'])){

        $room_id = $_POST['roomID'];
        $room_name = $_POST['roomName'];
        $room_type_id = $_POST['roomType'];
    
        $sql="UPDATE `room` SET `room_name`='$room_name',`room_type_id`='$room_type_id' WHERE `room_id`='$room_id'";

    }else if (isset($_GET['del'])){
        
        $room_id = $_GET['del'];

        $sql="DELETE FROM `room` WHERE `room_id`='$room_id'";
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