<?php
    include_once ("../config/dbconnect.php");

    $q = $_GET['search'];
    $search_qqq = explode("*", $q);

    $status = $search_qqq[0];
    $search = $search_qqq[1];

    if ($status==="all") {
        $status = "";
    }

    $query = "SELECT COUNT(*) AS count FROM booking JOIN room ON booking.booked_room = room.room_id JOIN room_type ON room.room_type_id = room_type.room_type_id WHERE (`room_name` LIKE '%$search%' OR `booking_id` LIKE '%$search%') AND `booking_status` LIKE '%$status%' ORDER BY `date_in` DESC";
    
    $result = mysqli_query($conn, $query);

    while ($booking = mysqli_fetch_array($result)) {
        $count=$booking['count'];
    }

    echo $count;
    exit();
?>