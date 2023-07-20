<?php
    include_once ("../config/dbconnect.php");
    session_start();

    $return_arr = array();

    if(isset($_GET['one-booking-logs'])){
        $id = $_POST['id'];
        $query = "SELECT service.*,
        room1.room_name AS room,
        room2.room_name AS old_room 
        FROM service
        INNER JOIN room AS room1 ON service.room_id = room1.room_id
        LEFT JOIN room AS room2 ON service.old_room_id = room2.room_id
        WHERE service.booking_id = '$id'";
        $result = mysqli_query($conn, $query);

        while ($log = mysqli_fetch_array($result)) {
            $bookingID=$log['booking_id'];
            $room=$log['room'];
            $old_room =$log['old_room'];
            $time=$log['time'];
            $movement=$log['action'];
            $memo=$log['memo'];
            
            
            $return_arr[] = array(
                "bookingID" => $bookingID,
                "room" => $room,
                "old_room"=>$old_room,
                "time"=>$time,
                "movement"=>$movement,
                "memo"=>$memo
            );
        }        
    }

    if (isset($_GET['all'])){

        $year = $_POST['year'];
        $month = $_POST['month'];

        $query = "SELECT * FROM `booking` NATURAL JOIN `service` WHERE `booking_status` <> 'Cancelled' AND (MONTH(`date_in`)=$month OR MONTH(`date_out`)=$month AND YEAR(`date_in`)=$year) ORDER BY `date_in`";
        $result = mysqli_query($conn, $query);

        while ($booking = mysqli_fetch_array($result)) {
            $b_id=$booking['booking_id'];
            $c_id=$booking['customer_id'];
            $r_id=$booking['room_id'];
            $old_r_id =$booking['old_room_id'];
            $dateIn=$booking['date_in'];
            $dateOut=$booking['date_out'];
            $duration=$booking['duration'];
            $bStatus=$booking['booking_status'];
            $movement_time=$booking['time'];
            $movement=$booking['action'];
            $memo=$booking['memo'];
            $payment = $booking['payment_status'];
            
            
            $return_arr[] = array(
                "b_id" => $b_id,
                "c_id" => $c_id,
                "roomID"=>$r_id,
                "bStatus"=>$bStatus,
                "oldRoomID"=>$old_r_id,
                "dateIn"=>$dateIn,
                "dateOut" => $dateOut,
                "duration"=>$duration,
                "payment"=>$payment,
                "movement"=>$movement,
                "movement_time"=>$movement_time,
                "memo"=>$memo,
            );
        }        
    }

    echo json_encode($return_arr);  
    exit();       
    
?>