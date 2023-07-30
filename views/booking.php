<h1 class="pt-1 pb-3 room_page_nav" data-i18n="booking.title"></h1>

<div class="d-flex justify-content-between align-items-center room_search_bar px-2 mb-3">
    <select name="floor" id="bookingTypeSelector" class="floorSelector" onchange="loadBooking()">
        <option value="all" selected data-i18n="selector.all">All</option>
        <option value="Reserved" data-i18n="schedule.status.reserve">Reserved</option>
        <option value="Staying" data-i18n="schedule.status.stay">Staying</option>
        <option value="Finished" data-i18n="schedule.status.finish">Finished</option>
    </select>
    <div class="input-group" style="width: 300px !important;">
        <input type="text" id="bookingSearchBar" class="form-control en-font" style="border:1px solid lightblue" 
        placeholder="Search..." value="" onkeyup="loadBooking()"/>
    </div>
</div> 

<table class="table table-borderless">
    <thead>
        <tr class="table-dark">
            <th scope="col" class="en-font">#</th>
            <th scope="col" class="en-font">ID</th>
            <th scope="col" data-i18n="booking.table.room">Room</th>
            <th scope="col" data-i18n="booking.table.type">Room Type</th>
            <th scope="col" class="en-font">Check In</th>
            <th scope="col" class="en-font">Check Out</th>
            <th scope="col" data-i18n="booking.table.duration">Duration</th>
            <th scope="col" data-i18n="booking.table.total">Total</th>
            <th scope="col" data-i18n="booking.table.payment">Payment</th>
            <th scope="col" data-i18n="booking.table.status">Status</th>
            <th scope="col" data-i18n="booking.table.action">Action</th>
        </tr>
    </thead>
    <tbody id="display_booking" class="table-group-divider">
        <?php
            $booking_query = "SELECT * FROM booking JOIN room ON booking.booked_room = room.room_id JOIN room_type ON room.room_type_id = room_type.room_type_id ORDER BY date_in DESC";

            $booking_result = mysqli_query($conn, $booking_query);
            $index = 1;
            while ($booking = mysqli_fetch_array($booking_result)) {

                if($booking['booking_status']==="Staying"){
                    $color = "bg-primary-subtle";
                    $stat_lang="booking.status.stay";
                }
                else if ($booking['booking_status']==="Reserved"){
                    $color = "bg-warning-subtle";
                    $stat_lang="booking.status.reserve";
                }
                else if ($booking['booking_status']==="Cancelled"){
                    $color = "bg-danger-subtle";
                    $stat_lang="booking.status.cancel";
                }
                else{
                    $color = "bg-success-subtle"; 
                    $stat_lang="booking.status.finish";
                }

                if($booking['payment_status']==="Paid"){
                    $pay_lang="payment.paid";
                }
                else if ($booking['payment_status']==="Deposit"){
                    $pay_lang="payment.deposit";
                }
                else{
                    $pay_lang="payment.unpaid";
                }

            ?>
                <tr class='<?php echo $color?>'>
                    <td class="align-middle en-font"> <?php echo $index++?> </td>
                    <td class="align-middle en-font"> <?php echo $booking['booking_id'] ?> </td>
                    <td class="align-middle en-font"><b> <?php echo $booking['room_name'] ?> </b></td>
                    <td class="align-middle en-font"><?php echo $booking['room_type_name'] ?></td>
                    <td class="align-middle fw-bold en-font"> <?php echo $booking['date_in'] ?> </td>
                    <td class="align-middle fw-bold en-font"> <?php echo $booking['date_out'] ?> </td>
                    <td class="align-middle"> 
                        <span class="en-font"><?php echo $booking['duration'] ?> </span>
                        <span data-i18n="booking.table.night"></span> 
                    </td>
                    <td class="align-middle en-font"> <?php echo number_format($booking['total_payment']) ?> KIP</td>
                    <td class="align-middle" data-i18n=<?php echo $pay_lang ?>> </td>
                    <td class="fw-bold align-middle bg-info-subtle after-bottom" data-i18n=<?php echo $stat_lang ?>> </td>
                    <td>
                        <button 
                            type="button" 
                            class="btn btn-success btn-sm" 
                            id="btnLogCollapse<?php echo $booking['booking_id'] ?>"
                            aria-expanded="false" 
                            onclick="showBookingLog('<?php echo $booking['booking_id'] ?>')"
                        >
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </button>

                        <button 
                            type="button" 
                            class="btn btn-primary btn-sm" 
                            onclick="viewBookingInfo('<?php echo $booking['booking_id']?>', 'booking')" 
                            data-bs-toggle="modal" 
                            data-bs-target="#bookingRoomModal"
                        >
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
                <td colspan="11" class="p-0 ">
                    <div class="collapse" id="bookingLog<?php echo $booking['booking_id'] ?>">
                        <div class="card card-body row <?php echo $color?> px-5 py-2" style="border:none !important">
                        </div>
                    </div>
                </td>
            <?php  }
        ?>
    </tbody>
</table>
