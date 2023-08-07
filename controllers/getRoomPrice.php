<?php
    include_once ("../config/dbconnect.php");

    if(isset($_GET['one'])){
        $id = $_GET['id'];
        $query = "SELECT `price` FROM `room_type` WHERE `room_type_id` = '$id'";
    }

    if(isset($_GET['room'])){
        $room = $_GET['room'];
        $query = "SELECT `price` FROM `room_type` NATURAL JOIN `room` WHERE room_name = '$room'";
    }

    $result = mysqli_query($conn, $query);

    $room_price = mysqli_fetch_assoc($result);
    echo mysqli_error($conn);
    echo json_encode ($room_price);
    
    exit();
?>