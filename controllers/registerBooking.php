<?php
    include_once ("../config/dbconnect.php");

    if (isset($_GET['register'])){
        $booking_ID = uniqid('b');
        $roomID = $_POST['roomID'];
        $customer = $_POST['customer'];
        $total = $_POST['total'];
        $duration = $_POST['duration'];
        $checkIn = $_POST['checkIn'];
        $checkOut = $_POST['checkOut'];
        $paymentOption = $_POST['paymentOption'];
        $paymentStatus = $_POST['paymentStatus'];

        $time = date('Y-m-d');

        $sql="INSERT INTO `booking`(`booking_id`, `customer_id`, `booked_room`, `date_in`, `date_out`, `duration`, `booking_status`, `total_payment`, `payment_option`, `payment_status`)
        VALUES ('$booking_ID','$customer', '$roomID', '$checkIn','$checkOut','$duration', 'Confirmed', '$total', '$paymentOption', '$paymentStatus');
        
        UPDATE `room` SET `room_status`='Reserved' WHERE `room_id`='$roomID';
        
        INSERT INTO `room_log`(`booking_id`, `room_id`, `time`, `action`, `memo`) VALUES ('$booking_ID','$roomID','$time','Reserved','')";

        $result = mysqli_multi_query($conn, $sql);
    }

    if (isset($_GET['extend'])){
    
        $id = $_GET['id'];
        $newDate = $_POST['newDate'];
        $duration = $_POST['duration'];
        $total = $_POST['total'];

        $query = "UPDATE `booking` SET `date_out` = '$newDate', `duration` = `duration` + '$duration', `total_payment` = `total_payment` + '$total' WHERE `booking_id` = '$id'";
    
        $result = mysqli_query($conn, $query);
    }

    if ($result){
        echo "success";
        exit();
    }else{
        echo mysqli_error($conn);
        exit();
    }
?>