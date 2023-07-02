<h1 class="pt-2 pb-3 room_page_nav">
    Booking Infomation
</h1>

<div class="d-flex justify-content-between align-items-center room_search_bar px-2 my-3">
    <select name="floor" id="bookingTypeSelector" class="floorSelector" onchange="loadBooking()">
        <option value="all" selected="select">All</option>
        <option value="Confirmed">Reserved</option>
        <option value="Staying">Staying</option>
        <option value="Finished">Finished</option>
    </select>
    <div class="input-group" style="width: 300px !important;">
        <input type="text" id="bookingSearchBar" class="form-control" style="border:1px solid lightblue" placeholder="Search" value="" onkeyup="loadBooking()"/>
    </div>
</div> 

<table class="table">
    <thead>
        <tr class="table-dark">
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Room</th>
            <th scope="col">Room Type</th>
            <th scope="col">Check In</th>
            <th scope="col">Check Out</th>
            <th scope="col">Duration</th>
            <th scope="col">Total</th>
            <th scope="col">Payment</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="display_booking" class="table-group-divider">
        <?php
            $booking_query = "SELECT * FROM booking JOIN room ON booking.booked_room = room.room_id JOIN room_type ON room.room_type_id = room_type.room_type_id";
            $booking_result = mysqli_query($conn, $booking_query);
            $index = 1;
            while ($booking = mysqli_fetch_array($booking_result)) {

                if($booking['booking_status']==="Staying"){
                    $color = "table-primary";
                }
                else if ($booking['booking_status']==="Confirmed"){
                    $color = "table-warning";
                }
                else if ($booking['booking_status']==="Cancelled"){
                    $color = "table-danger";
                }
                else{
                    $color = "table-success"; 
                }

            ?>
                <tr class=<?php echo $color?>>
                    <td class="align-middle"> <?php echo $index++?> </td>
                    <td class="align-middle"> <?php echo $booking['booking_id'] ?> </td>
                    <td class="align-middle"><b> <?php echo $booking['room_name'] ?> </b></td>
                    <td class="align-middle"><?php echo $booking['room_type_name'] ?></td>
                    <td class="align-middle fw-bold"> <?php echo $booking['date_in'] ?> </td>
                    <td class="align-middle fw-bold"> <?php echo $booking['date_out'] ?> </td>
                    <td class="align-middle"> <?php echo $booking['duration'] ?> Nights </td>
                    <td class="align-middle"> <?php echo number_format($booking['total_payment']) ?> KIP</td>
                    <td class="align-middle"> <?php echo $booking['payment_status'] ?> </td>
                    <td class="align-middle bg-info-subtle fw-bold"> <?php echo $booking['booking_status'] ?> </td>
                    <td class="d-flex justify-content-around">
                        <button 
                            type="button" 
                            class="btn btn-primary btn-sm" 
                            onclick="viewBookingInfo('<?php echo $booking['booking_id']?>')" 
                            data-bs-toggle="modal" 
                            data-bs-target="#bookingRoomModal"
                            <?php if($booking['booking_status']==="Finished" || $booking['booking_status']==="Maintenanace") echo 'disabled'?>
                        >
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            <?php  }
        ?>
    </tbody>
</table>
