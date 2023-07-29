<?php
    include_once ("../config/dbconnect.php");

    $return_arr = array();

    if (isset($_GET['chart'])){

        if (isset($_GET['roomType'])){
            $query = "SELECT room_type_name, COUNT(*) FROM room NATURAL JOIN room_type GROUP BY room_type_name;";
        }
        if (isset($_GET['roomStat'])){
            $query = "SELECT room_status, COUNT(*) FROM room GROUP BY room_status;";
        }
        if (isset($_GET['room_popularity'])){
            $query = "SELECT room_name, COUNT(*) FROM booking JOIN room WHERE booking.booked_room = room.room_id GROUP BY booked_room;";
        }
        if (isset($_GET['room_revenue'])){
            $query = "SELECT room_name, SUM(total_payment) FROM booking JOIN room WHERE booking.booked_room = room.room_id GROUP BY booked_room;";
        }
        if (isset($_GET['room_bar_chart'])){

            $period = $_POST['period'];
            
            switch ($period) {
                case '1w':
                    $duration = "BETWEEN NOW() - INTERVAL 7 DAY AND NOW()";
                    break;

                case '1m':
                    $duration = "BETWEEN NOW() - INTERVAL 1 MONTH AND NOW()";
                    break;
                
                case '6m':
                    $duration = "BETWEEN NOW() - INTERVAL 6 MONTH AND NOW()";
                    break;
            
                case '1y':
                    $duration = "BETWEEN NOW() - INTERVAL 12 MONTH AND NOW()";
                    break;
                        
                default:
                    $duration = "BETWEEN NOW() - INTERVAL 7 DAY AND NOW()";
                    break;
            }

            $query = "SELECT room_name, COUNT(*)
                FROM booking JOIN room ON booking.booked_room = room.room_id
                WHERE booking_status <> 'Cancelled' AND date_in $duration 
                GROUP BY booked_room
                LIMIT 5;
            ";
        }
        if (isset($_GET['room_pie_chart'])){

            $period = $_POST['period'];
            
            switch ($period) {
                case '1w':
                    $duration = "BETWEEN NOW() - INTERVAL 7 DAY AND NOW()";
                    break;

                case '1m':
                    $duration = "BETWEEN NOW() - INTERVAL 1 MONTH AND NOW()";
                    break;
                
                case '6m':
                    $duration = "BETWEEN NOW() - INTERVAL 6 MONTH AND NOW()";
                    break;
            
                case '1y':
                    $duration = "BETWEEN NOW() - INTERVAL 12 MONTH AND NOW()";
                    break;
                        
                default:
                    $duration = "BETWEEN NOW() - INTERVAL 7 DAY AND NOW()";
                    break;
            }

            $query = "SELECT room_type_name, COUNT(*)
                FROM booking 
                JOIN room ON booking.booked_room = room.room_id
                JOIN room_type ON room.room_type_id = room_type.room_type_id
                WHERE booking.booked_room = room.room_id AND booking_status <> 'Cancelled' AND date_in $duration 
                GROUP BY room_type_name;
            ";
        }
        
        $result = mysqli_query($conn, $query);
        
        while ($row = mysqli_fetch_array($result)) {
            $name=$row[0];
            $total=$row[1];

            $return_arr[] = array(
                "name" => $name,
                "total" => $total,
            );
        }
    }

    if(isset($_GET['revenue'])){
        if (isset($_GET['weekly'])){
            $query = "SELECT date_in AS month, SUM(total_payment), COUNT(*)
                FROM booking 
                WHERE booking_status <> 'Cancelled' AND date_in BETWEEN NOW() - INTERVAL 7 DAY AND NOW()
                GROUP BY date_in;
            ";
        }
        if (isset($_GET['monthly'])){
            $query = "SELECT FROM_DAYS(TO_DAYS(date_in) - MOD(TO_DAYS(date_in) -(WEEKDAY(CURDATE()) + 2), 7)), SUM(total_payment), COUNT(*)
                FROM booking 
                WHERE booking_status <> 'Cancelled' AND date_in BETWEEN NOW() - INTERVAL 1 MONTH AND NOW()
                GROUP BY FROM_DAYS(TO_DAYS(date_in) - MOD(TO_DAYS(date_in) -(WEEKDAY(CURDATE()) + 2), 7));
            ";
        }
        if (isset($_GET['6months'])){
            $query = "SELECT CONCAT(MONTHNAME(date_in), ' ', YEAR(date_in)), SUM(total_payment), COUNT(*)
                FROM booking 
                WHERE booking_status <> 'Cancelled' AND date_in BETWEEN NOW() - INTERVAL 6 MONTH AND NOW()
                GROUP BY MONTHNAME(date_in);
            ";
        }
        if (isset($_GET['yearly'])){
            $query = "SELECT CONCAT(MONTHNAME(date_in), ' ', YEAR(date_in)), SUM(total_payment), COUNT(*)
                FROM booking 
                WHERE booking_status <> 'Cancelled' AND date_in BETWEEN NOW() - INTERVAL 12 MONTH AND NOW()
                GROUP BY MONTHNAME(date_in);
            ";
        }
        
        $result = mysqli_query($conn, $query);
        
        while ($row = mysqli_fetch_array($result)) {
            $name=$row[0];
            $total=$row[1];
            $count=$row[2];

            $return_arr[] = array(
                "name" => $name,
                "total" => $total,
                "count" => $count,
            );
        }
    }

    if(isset($_GET['bookings'])){
        $period = $_POST['period'];
            
        switch ($period) {
            case '1w':
                $duration = "BETWEEN NOW() - INTERVAL 7 DAY AND NOW()";
                break;

            case '1m':
                $duration = "BETWEEN NOW() - INTERVAL 1 MONTH AND NOW()";
                break;
            
            case '6m':
                $duration = "BETWEEN NOW() - INTERVAL 6 MONTH AND NOW()";
                break;
        
            case '1y':
                $duration = "BETWEEN NOW() - INTERVAL 12 MONTH AND NOW()";
                break;
                    
            default:
                $duration = "BETWEEN NOW() - INTERVAL 7 DAY AND NOW()";
                break;
        }
        
        $query = "SELECT * FROM booking NATURAL JOIN employee
            WHERE booking_status <> 'Cancelled' AND date_in $duration
            ORDER BY total_payment 
            DESC LIMIT 10;
        ";

        $result = mysqli_query($conn, $query);
        
        while ($booking = mysqli_fetch_array($result)) {
            $id=$booking['booking_id'];
            $employee=$booking['emp_Name'];
            $checkIn=$booking['date_in'];
            $checkOut=$booking['date_out'];
            $duration=$booking['duration'];
            $total=$booking['total_payment'];
            $status = $booking['booking_status'];
            
            $return_arr[] = array(
                "id" => $id,
                "employee"=>$employee,
                "checkIn"=>$checkIn,
                "checkOut" => $checkOut,
                "total" => $total,
                "duration" => $duration,
                "status"=>$status
            );
        }
    }

    echo mysqli_error($conn);
    echo json_encode($return_arr);

    exit();
?>