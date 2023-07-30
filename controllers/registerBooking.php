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
        $employee = $_POST['employee'];
        $codes = $_POST['codes'];

        $time = date('Y-m-d');

        $sql="INSERT INTO `booking`(`booking_id`, `customer_id`, `emp_ID`, `booked_room`, `date_in`, `date_out`, `duration`, `booking_status`, `total_payment`, `payment_option`, `payment_status`, `onepay_ref_code`)
        VALUES ('$booking_ID','$customer', '$employee', '$roomID', '$checkIn','$checkOut','$duration', 'Reserved', '$total', '$paymentOption', '$paymentStatus', '$codes');
        
        UPDATE `room` SET `room_status`='Reserved' WHERE `room_id`='$roomID';
        
        INSERT INTO `service`(`booking_id`, `room_id`, `time`, `action`, `memo`) VALUES ('$booking_ID','$roomID','$time','Reserved','')";

        $result = mysqli_multi_query($conn, $sql);
    }

    if (isset($_GET['extend'])){
    
        $id = $_GET['id'];
        $roomID = $_POST['roomID'];
        $newDate = $_POST['newDate'];
        $duration = $_POST['duration'];
        $total = $_POST['total'];
        $total_comma = number_format($total);
        $time = $_POST['time'];

        $query = "UPDATE `booking` SET `date_out` = '$newDate', `duration` = `duration` + '$duration', `total_payment` = `total_payment` + '$total', `payment_status`='Deposit' WHERE `booking_id` = '$id';
        INSERT INTO `service`(`booking_id`, `room_id`, `time`, `action`, `memo`) VALUES ('$id', '$roomID', '$time', 'Extended', 'Extend The Hotel Duration By $duration Days With Total Of $total_comma KIP');
        ";
    
        $result = mysqli_multi_query($conn, $query);
    }

    if ($result){
        echo "success";
        exit();
    }else{
        echo mysqli_error($conn);
        exit();
    }
?>