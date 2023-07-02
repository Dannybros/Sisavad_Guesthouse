<div class="modal fade" id="bookingRoomModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Booking Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4 class="text-start mb-3 text-success">Client Info</h4>
            <table class="table table-striped border border-dark border-2">
                <thead>
                    <tr>
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
        <div class="modal-footer d-flex justify-content-between" id="bookingModal_footer">
            <div class="button-group">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="payBooking()">Paid</button>
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-danger" data-bs-target="#cancelModal" data-bs-toggle="modal">Cancel Booking</button>
                <button type="button" class="btn btn-info" data-bs-target="#moveRoomModal" data-bs-toggle="modal">Move Room</button>
                <button type="button" class="btn btn-dark" onclick="openExtendDateModal()" data-bs-target="#extendBookingModal" data-bs-toggle="modal">Extend Booking</button>
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-success" onclick="roomCheckIn()">Check In</button>
                <button type="button" class="btn btn-warning" onclick="roomCheckOut()">Check Out</button>
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
                onchange="calculateDuration_Total(old_check_out_date, new_check_out_date, 'extend_room_price', 'extend_duration', 'extend_total')"  
                class="form-control" 
                data-error="Select Check In Date"  
                required
            />
        </div>

        <figure class="d-flex pt-4 mb-0 justify-content-between">
            <b>Extend Duration: <label style="color:#fd7e14" id="extend_duration"> 0 Night </label> </b>
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

<div class="modal fade" id="moveRoomModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">Moving Room Info</h1>
            <button type="button" class="btn-close" data-bs-target="#bookingRoomModal" data-bs-toggle="modal" onclick="backToBookingModal()"></button>
        </div>
        <div class="modal-body row">
            <article class="col-12">
                <h5 style="float:left"><b> Room Type</b></h5>
                <select class="form-control" id="movingRoomType" name="roomType" onchange="getFreeRoomForMoving(this.value)" data-error="Select Room Type" required>
                    <option selected disabled value="disabled"> Select the Room Type</option>
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
            </article>

            <article class="col-lg-12 mt-4">
                <h5 style="float:left" class="mb-2"><b>Room No.</b> </h5>
                <select 
                    class="form-control" 
                    id="availableRooms" 
                    name="available_room_id" 
                >
                    <option selected disabled> Please select the room no. </option>
                </select>
            </article>

            <article class="col-lg-12 mt-4">
                <h5 style="float:left" class="mb-2"><b>Memo</b> </h5>
                <textarea id="movingRoomMemo" class="form-control" placeholder="Write memo..."></textarea>
            </article>

            <figure class="d-flex pt-4 mb-0 justify-content-between">
                <b class="col-4">Remaining Duration <label style="color:#fd7e14" id="remaining_days"> 0 Night </label> </b>
                <b class="col-4">New Room Price <label style="color:#fd7e14" id="origin_price">  20,000 KIP</label> </b>
                <b class="col-4">Addidtion Charge <label class="text-primary" id="movingExtraFee"> 0 KIP </label> </b>
            </figure>

        </div>
      <div class="modal-footer">
        <button class="btn btn-info" data-bs-target="#bookingRoomModal" data-bs-toggle="modal" onclick="backToBookingModal()">Back</button>
        <button class="btn btn-success" id="btnMoveRoom" onclick="moveRoom()">Move Room</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cancelModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5"> Cancel Memo</h1>
        <button type="button" class="btn-close" data-bs-target="#bookingRoomModal" data-bs-toggle="modal"></button>
      </div>
      <div class="modal-body">
        <textarea id="cancelMemo" class="form-control" placeholder="Write memo..."></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" data-bs-target="#bookingRoomModal" data-bs-toggle="modal"  onclick="backToBookingModal()">Back</button>
        <button class="btn btn-danger" id="btnCancelBooking" onclick="cancelBooking()">Cancel Booking</button>
      </div>
    </div>
  </div>
</div>