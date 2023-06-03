<?php
    include_once ("../config/dbconnect.php");

    $booking_ID =  $_GET['id'];

    $sql="UPDATE `booking` SET `payment_status`='true' WHERE `booking_id`='$booking_ID';";

    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        echo "success";
        exit();
    }else {
        echo mysqli_error($conn);
        exit();
    }
?>