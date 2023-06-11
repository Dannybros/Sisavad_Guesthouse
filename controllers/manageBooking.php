<?php
    include_once ("../config/dbconnect.php");

    if (isset($_GET['all'])){

        $return_arr = array();
    
        $id = $_GET['id'];
        $query = "SELECT * FROM booking NATURAL JOIN room WHERE `booking_id` = '$id'";
    
        $result = mysqli_query($conn, $query);
    
        while ($booking = mysqli_fetch_array($result)) {
            $id=$booking['booking_id'];
            $customers=$booking['customer_id'];
            $room=$booking['room_name'];
            $roomID = $booking['room_id'];
            $checkIn=$booking['date_in'];
            $checkOut=$booking['date_out'];
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
    }

    if (isset($_GET['extend'])){
    
        $id = $_GET['id'];
        $newDate = $_POST['newDate'];
        $duration = $_POST['duration'];
        $total = $_POST['total'];

        $query = "UPDATE `booking` SET `date_out` = '$newDate', `duration` = `duration` + '$duration', `total_payment` = `total_payment` + '$total' WHERE `booking_id` = '$id'";

    
        $result = mysqli_query($conn, $query);

        if ($result){
            echo "success";
            exit();
        }else{
            echo mysqli_error($conn);
            exit();
        }
    }
?>