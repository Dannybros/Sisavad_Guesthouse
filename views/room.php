<h1 class="pt-2 pb-3 room_page_nav">
    ROOMS
</h1>

<div class="d-flex justify-content-between align-items-center room_search_bar px-2">
    <select name="floor" id="roomTypeSelector" class="floorSelector" onchange="loadRooms()">
        <option value="all" selected="select">All</option>
        <?php
            $sql ="SELECT * FROM `room_type`";
            $result = mysqli_query($conn, $sql);
            while($roomType = mysqli_fetch_array($result)){?>
                <option 
                    value=<?php echo $roomType['room_type_id']?> 
                >
                    <?php echo $roomType['room_type_name']?>
                </option>
        <?php }?>
    </select>
    <div class="input-group" style="width: 300px !important;">
        <input type="text" id="roomSearchBar" class="form-control" style="border:1px solid lightblue" placeholder="Search" value="" onkeyup="loadRooms()"/>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roomModal" onclick="addNewRoom()">
        <i class="fa fa-plus"></i>
        Add New Room
    </button>
</div> 

<table class="table">
    <thead>
        <tr class="table-dark">
            <th scope="col">ID</th>
            <th scope="col">Room</th>
            <th scope="col">Type</th>
            <th scope="col">Price</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="display_room" class="table-group-divider ">
        <?php
            $room_query = "SELECT * FROM `room` NATURAL JOIN `room_type` ORDER BY room_name";
            $room_result = mysqli_query($conn, $room_query);
            while ($rooms = mysqli_fetch_assoc($room_result)) {

                $customer = "disabled";
                $booking = "disabled";
                
                if($rooms['room_status']==="Booked"){
                    $color = "table-primary";
                    $booking="";
                }
                else if ($rooms['room_status']==="Maintenance"){
                    $color = "table-danger";
                }
                else if ($rooms['room_status']==="Staying"){
                    $color = "table-warning";
                    $customer="";
                    $booking="";
                }
                else{
                    $color = "table-success"; 
                }
            ?>
                <tr class=<?php echo $color?>>
                    <td class="align-middle"> <?php echo $rooms['room_id'] ?> </td>
                    <td class="align-middle"><b> <?php echo $rooms['room_name'] ?> </b></td>
                    <td class="align-middle"> <?php echo $rooms['room_type_name'] ?> </td>
                    <td class="align-middle"> <?php echo number_format($rooms['price']) ?> KIP</td>
                    <td class="align-middle"><b> <?php echo $rooms['room_status'] ?> </b></td>
                    <td class="d-flex justify-content-around">
                        <button 
                            type="button" 
                            class="btn btn-primary btn-sm" 
                            onclick="viewRoomInfo('<?php echo $rooms['room_id']?>')" 
                            data-bs-toggle="modal" 
                            data-bs-target="#roomModal"
                        >
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                        <button 
                            type="button" 
                            class="btn btn-secondary btn-sm" <?php echo $customer?>
                        >
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                        </button>
                        <button 
                            type="button" 
                            class="btn btn-success btn-sm" <?php echo $booking?>
                            onclick="viewBookingInfo('<?php echo $rooms['booking_id']?>')" 
                            data-bs-toggle="modal" 
                            data-bs-target='#bookingRoomModal'
                        >
                            <i class="fa fa-bookmark" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            <?php  }
        ?>
    </tbody>
</table>


<!-- <div class="display_room row my-4 overflow-auto" id="display_room"> -->
<!-- <main class="room_box p-3 rounded-10" id="room_box">
        <div class="room_title p-0 <?php echo $color?>" style="--bs-bg-opacity: .5;">
        <?php echo $rooms['room_name'] ?>
        </div>
        <article class="border">
            <aside class="bg-white py-2 border-bottom"> 
                <b>
                    <?php echo $rooms['room_type_name'] ?>
                    &nbsp; 
                    (<?php echo $rooms['room_status'] ?>)
                </b>
            </aside>
            <div class="bg-white py-2 d-flex justify-content-around">
                <em class="btn btn-success" onclick="viewRoomInfo('<?php echo $rooms['room_id']?>')" data-bs-toggle="modal" data-bs-target="#roomModal" >
                    View
                </em>
                <?php
                if($rooms['room_status']=="Booked"){?>
                    <em class="btn btn-primary staff_icon" onclick="viewBookingInfo('<?php echo $rooms['booking_id']?>')" data-bs-toggle="modal" data-bs-target='#bookingRoomModal'>
                        Booking
                    </em>
                <?php }?>
            </div>
        </article>
    </main> -->

<div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="roomModalTitle">Room Info</h1>
                <button type="button" id="roomModalClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" onsubmit="manageRoom(event)" id="roomModalForm">
                <main class="modal-body row" style="height:100%; row-gap:20px" >
                    <div class="col-6">
                        <label class="my-2" style="float:left">Room Name</label>
                        <input type="text" id="roomModal_name" class="text-center form-control" placeholder="Room Name" data-error="please fill in the room title" required/>
                    </div>
                    <div class="col-6">
                        <label class="my-2" style="float:left">Room Type</label>
                        <select 
                            id="roomModal_type" 
                            class="form-control"
                            onchange="getRoomTypePrice(this.value)"
                            data-error="please choose the room type"
                            required
                        >
                            <option selected disabled> -- choose room type -- </option>
                            <?php
                                $sql ="SELECT * FROM `room_type`";
                                $result = mysqli_query($conn, $sql);
                                while($roomType = mysqli_fetch_array($result)){?>
                                    <option 
                                        value=<?php echo $roomType['room_type_id']?> 
                                    >
                                        <?php echo $roomType['room_type_name']?>
                                    </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="my-2" style="float:left">Room Price</label>
                        <input type="text" class="text-center form-control" id="roomModal_price" disabled/>
                    </div>
                    <div class="col-6">
                        <label class="my-2" style="float:left">Room Status:</label> &nbsp;
                        <input type="text" class="form-control text-center text-success" id="roomModal_status" disabled value="Free"/>
                    </div>
                </main>
                <div class="modal-footer">
                    <button type="submit" id="btnRoomModalSubmit" class="btn btn-primary">ADD</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="button" onclick="delRoom()" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="bookingRoomModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Booking Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4 class="text-start mb-2">Client Info</h4>
            <table class="table table-striped table-group-divider">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Phone</th>
                        <th scope="col">ID/Passport</th>
                    </tr>
                </thead>
                <tbody id="bookedCustomerTb" class="table-group-divider"></tbody>
            </table>
            
            <section class="row mt-4">
                <figure class="col-4 text-primary">
                    Room: 
                    <input type="text" class="form-control text-center" disabled id="bookedRoom" style="font-weight: bold;" value=""/>
                </figure>
                <figure class="col-4 text-primary">
                    Booked From: 
                    <input type="text" class="form-control text-center" disabled id="bookingCID" style="font-weight: bold;" value=""/>
                </figure>
                <figure class="col-4 text-primary">
                    Booked To : 
                    <input type="text" class="form-control text-center" disabled id="bookingCOD" style="font-weight: bold;" value=""/>
                </figure>

                <div class="my-2 border"></div>

                <figure class="col-4 text-success">
                    Duration:
                    <input type="text" class="form-control text-center" disabled id="bookingModalDuration" style="font-weight: bold;" value=""/>
                </figure>
                <figure class="col-4 text-success">
                    Total:
                    <input type="text" class="form-control text-center" disabled id="bookingModalTotal" style="font-weight: bold;" value=""/>
                </figure>
                <figure class="col-4 text-success"> 
                    Payment Status:
                    <input type="text" class="form-control text-center text-capitalize" disabled id="bookingModalPayment" style="font-weight: bold;" value=""/>
                </figure>
            </section>
        </div>
        <div class="modal-footer d-flex justify-content-between">
            <div class="button-group">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="payBooking()">Paid</button>
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-danger" onclick="openCancelModal()" data-bs-target="#memoModal" data-bs-toggle="modal">Cancel Booking</button>
                <button type="button" class="btn btn-info" onclick="openMoveModal()" data-bs-target="#memoModal" data-bs-toggle="modal">Move Room</button>
                <button type="button" class="btn btn-dark" onclick="openExtendDateModal()" data-bs-target="#extendBookingModal" data-bs-toggle="modal">Extend Booking</button>
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-success" onclick="roomCheckIn_Out('Checked In')">Check In</button>
                <button type="button" class="btn btn-warning" onclick="roomCheckIn_Out('Checked Out')">Check Out</button>
            </div>
            
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="extendBookingModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Extend the Duration</h1>
        <button type="button" class="btn-close" data-bs-target="#bookingRoomModal" data-bs-toggle="modal"></button>
      </div>
      <div class="modal-body row">
        <div class="col-6">
            <h5 style="float:left"><b>Old Check out Date</b></h5>
            <input 
                type="date" 
                id="old_check_out_date"  
                class="form-control" 
                disabled
            />
        </div>
        <div class="col-6">
            <h5 style="float:left"><b>New Check Out Date</b></h5>
            <input 
                type="date" 
                id="new_check_out_date" 
                onchange="getDuration(old_check_out_date, new_check_out_date, 'extend_room_price', 'extend_duration', 'extend_total')"  
                class="form-control" 
                data-error="Select Check In Date"  
                required
            />
        </div>

        <figure class="d-flex pt-4 mb-0 justify-content-between">
            <b>Extend Duration: <label style="color:#fd7e14" id="extend_duration"> 0 Day </label> </b>
            <b class="col-4">Price: <label style="color:#fd7e14" id="extend_room_price"></label> </b>
            <b class="col-4">Extend Total: <label style="color:#fd7e14" id="extend_total"> 0 KIP </label> </b>
        </figure>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" data-bs-target="#bookingRoomModal" data-bs-toggle="modal">Back</button>
        <button class="btn btn-primary" onclick="extendBookingDate()">Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="memoModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Memo</h1>
        <button type="button" class="btn-close" data-bs-target="#bookingRoomModal" data-bs-toggle="modal"></button>
      </div>
      <div class="modal-body">
        <select class="form-control mb-3" id="memoRoomSelect">
            <option selected disabled> Pick A Moved Room</option>
            <?php
                $sql ="SELECT * FROM `room` NATURAL JOIN room_type";
                $result = mysqli_query($conn, $sql);
                while($room = mysqli_fetch_array($result)){?>
                    <option 
                        value=<?php echo $room['room_id']?> 
                    >
                        <?php echo $room['room_name']."  (".$room['room_type_name'].")" ?>
                    </option>
            <?php }?>
        </select>
        <textarea id="bookingMemo" class="form-control" placeholder="Write memo..."></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" data-bs-target="#bookingRoomModal" data-bs-toggle="modal">Back</button>
        <button class="btn btn-primary" onclick="Move_CancelRoom()">Submit</button>
      </div>
    </div>
  </div>
</div>