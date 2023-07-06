<?php
    include_once ("../config/dbconnect.php");

    $booking_ID =  $_GET['id'];
    $status =  $_POST['status'];
    $option =  $_POST['option'];

    $sql="UPDATE `booking` SET `payment_status`='$status', `payment_option`='$option' WHERE `booking_id`='$booking_ID';";

    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        echo "success";
        exit();
    }else {
        echo mysqli_error($conn);
        exit();
    }
?>