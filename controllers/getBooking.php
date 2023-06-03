<?php
    include_once ("../config/dbconnect.php");

   
    $return_arr = array();

    $id = $_GET['id'];
    $query = "SELECT * FROM booking NATURAL JOIN room WHERE `booking_id` = '$id'";

    $result = mysqli_query($conn, $query);

    while ($booking = mysqli_fetch_array($result)) {
        $id=$booking['booking_id'];
        $customers=$booking['customer_id'];
        $room=$booking['room_name'];
        $roomID = $booking['room_id'];
        $checkIn=$booking['date_check_in'];
        $checkOut=$booking['date_check_out'];
        $duration=$booking['duration'];
        $total=$booking['total_payment'];
        $payment=$booking['payment_status'];

        
        $return_arr[] = array(
            "id" => $id,
            "customers" => $customers,
            "room"=>$room,
            "roomID"=>$roomID,
            "checkIn"=>$checkIn,
            "checkOut" => $checkOut,
            "duration"=>$duration,
            "total" => $total,
            "payment"=>$payment
        );
    }

    echo json_encode($return_arr);

    exit();
?>