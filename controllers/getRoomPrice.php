<?php
    include_once ("../config/dbconnect.php");

    $id = $_GET['id'];

    $query = "SELECT `price` FROM `room_type` WHERE `room_type_id` = '$id'";
    $result = mysqli_query($conn, $query);

    $room_price = mysqli_fetch_assoc($result);
    echo json_encode ($room_price);
    
    exit();
?>