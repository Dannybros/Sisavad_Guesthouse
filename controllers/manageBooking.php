<?php
    include_once ("../config/dbconnect.php");

    $return_arr = array();

    if (isset($_GET['single'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM booking JOIN room ON booking.booked_room = room.room_id JOIN room_type ON room.room_type_id = room_type.room_type_id WHERE `booking_id` = '$id'";
    }

    if (isset($_GET['all'])){

        $q = $_GET['search'];
        $search_qqq = explode("*", $q);

        $status = $search_qqq[0];
        $search = $search_qqq[1];

        if ($status==="all") {
            $status = "";
        }

        $query = "SELECT * FROM booking JOIN room ON booking.booked_room = room.room_id JOIN room_type ON room.room_type_id = room_type.room_type_id WHERE `room_name` LIKE '%$search%' OR `booking_id` LIKE '%$search%' AND `booking_status` LIKE '%$status%' ORDER BY `date_in` DESC";

    }

    if(isset($_GET['room'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM booking JOIN room ON booking.booked_room = room.room_id JOIN room_type ON room.room_type_id = room_type.room_type_id WHERE `booked_room` = '$id' AND `booking_status` <> 'Finished'";
    }
    
    $result = mysqli_query($conn, $query);

    while ($booking = mysqli_fetch_array($result)) {
        $id=$booking['booking_id'];
        $customers=$booking['customer_id'];
        $room=$booking['room_name'];
        $roomType=$booking['room_type_name'];
        $roomID = $booking['room_id'];
        $checkIn=$booking['date_in'];
        $checkOut=$booking['date_out'];
        $duration=$booking['duration'];
        $price=$booking['price'];
        $total=$booking['total_payment'];
        $status = $booking['booking_status'];
        $paymentStatus=$booking['payment_status'];
        $paymentOption=$booking['payment_option'];
        $codes=$booking['onepay_ref_code'];
        
        $return_arr[] = array(
            "id" => $id,
            "customers" => $customers,
            "codes" => $codes,
            "room"=>$room,
            "roomType"=>$roomType,
            "roomID"=>$roomID,
            "checkIn"=>$checkIn,
            "checkOut" => $checkOut,
            "duration"=>$duration,
            "price"=>$price,
            "total" => $total,
            "status"=>$status,
            "paymentStatus"=>$paymentStatus,
            "paymentOption"=>$paymentOption
        );
    }

    echo json_encode($return_arr);
    exit();
?>