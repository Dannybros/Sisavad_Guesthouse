<?php
    include_once ("../config/dbconnect.php");

    $booking_ID =  $_GET['id'];
    $status = $_POST['status'];
    $option = $_POST['option'];
    $codes = $_POST['codes'];
    $codes = !empty($codes) ? "'$codes'" : "NULL";

    $sql="UPDATE `booking` SET `payment_status`='$status', `payment_option`='$option', `onepay_ref_code`= $codes WHERE `booking_id`='$booking_ID';";

    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        echo "success";
        exit();
    }else {
        echo mysqli_error($conn);
        exit();
    }
?>