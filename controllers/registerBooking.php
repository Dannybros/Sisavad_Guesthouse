<?php
    include_once ("../config/dbconnect.php");

    $booking_ID = uniqid('b');
    $roomID = $_POST['roomID'];
    $customer = $_POST['customer'];
    $total = $_POST['total'];
    $duration = $_POST['duration'];
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];
    $cbPayment = $_POST['cbPayment'];

    $time = date('Y-m-d');

    $sql="INSERT INTO `booking`(`booking_id`, `customer_id`, `date_in`, `date_out`, `duration`, `booking_status`, `total_payment`, `payment_status`)
     VALUES ('$booking_ID','$customer','$checkIn','$checkOut','$duration', 'Confirmed', '$total','$cbPayment');
    
    UPDATE `room` SET `room_status`='Booked', `booking_id`='$booking_ID' WHERE `room_id`='$roomID';
    
    INSERT INTO `room_log`(`booking_id`, `room_id`, `time`, `action`, `memo`) VALUES ('$booking_ID','$roomID','$time','Reserved','')";

    $result = mysqli_multi_query($conn, $sql);
    
    if ($result) {
        echo "success";
        exit();
    }else {
        echo mysqli_error($conn);
        exit();
    }
?>