<div class="modal fade" id="bookingRoomModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
                <span data-i18n="booking.info.title"></span> 
                (<span id="booking_ID_Title"></span>)
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4 class="text-start mb-3 text-success" data-i18n="customer.title">Client Info</h4>
            <table class="table table-striped border border-dark border-2">
                <thead>
                    <tr>
                        <th scope="col" data-i18n="customer.fullname">Full Name</th>
                        <th scope="col" data-i18n="customer.bd">Birthday</th>
                        <th scope="col" data-i18n="customer.phone">Contact</th>
                        <th scope="col email" data-i18n="customer.email"></th>
                        <th scope="col email" data-i18n="customer.passport">ID/Passport</th>
                    </tr>
                </thead>
                <tbody id="bookedCustomerTb" class="table-group-divider"></tbody>
            </table>
            
            <section class="row mt-3">
                <figure class="col-3 text-primary">
                    <span data-i18n="booking.table.room"></span>:
                    <input type="text" class="form-control text-center en-font" disabled id="bookedRoom" style="font-weight: bold;" value=""/>
                </figure> 
                <figure class="col-3 text-primary en-font">
                    <span data-i18n="booking.info.checkin"></span>:
                    <input type="text" class="form-control text-center" disabled id="bookingCID" style="font-weight: bold;" value=""/>
                </figure>
                <figure class="col-3 text-primary en-font">
                    <span data-i18n="booking.info.checkout"></span>:
                    <input type="text" class="form-control text-center" disabled id="bookingCOD" style="font-weight: bold;" value=""/>
                </figure>
                <figure class="col-3 text-primary">
                    <span data-i18n="booking.info.status"></span>:
                    <input type="text" class="form-control text-center en-font" disabled id="bookingStatus" style="font-weight: bold;" value=""/>
                </figure>

                <div class="my-2 border"></div>

                <figure class="col-3 text-success">
                    <span data-i18n="booking.info.duration"></span>:
                    <input type="text" class="form-control text-center en-font" disabled id="bookingModalDuration" style="font-weight: bold;" value=""/>
                </figure>
                <figure class="col-3 text-success">
                    <span data-i18n="booking.info.total"></span>:
                    <input type="text" class="form-control text-center en-font" disabled id="bookingModalTotal" style="font-weight: bold;" value=""/>
                </figure>
                <figure class="col-3 text-success"> 
                    <span data-i18n="booking.info.payment.status.title"></span>:
                    <input type="text" class="form-control text-center en-font text-capitalize" disabled id="bookingModalPayment" style="font-weight: bold;" value=""/>
                </figure>
                <figure class="col-3 text-success"> 
                    <span data-i18n="booking.info.payment.option.title"></span>:
                    <select 
                        class="form-control text-center text-capitalize fw-bold en-font" 
                        id="bookingPaymentOption"
                        disabled
                    >
                        <option selected disabled data-i18n="booking.info.payment.option.default"> -- Choose --</option>
                        <option value="Cash"> Cash</option>
                        <option value="OnePay" class="en-font"> OnePay </option>
                    </select>
                </figure>
            </section>
        </div>
        <div class="modal-footer d-flex justify-content-between" id="bookingModal_footer">
            <div class="button-group">
                <button 
                    type="button" 
                    data-i18n="payment.full_pay" 
                    class="btn btn-primary"    
                    onclick="payBooking('Paid')"
                >
                    Full Pay
                </button>
                <button 
                    type="button" 
                    data-i18n="payment.deposit" 
                    class="btn btn-secondary" 
                    onclick="payBooking('Deposit')"
                ></button>
            </div>
            <div class="button-group">
                <button 
                    type="button" 
                    data-i18n="booking.btnList.cancel" 
                    class="btn btn-danger" 
                    data-bs-target="#cancelModal" 
                    data-bs-toggle="modal"
                >   
                    Cancel Booking
                </button>
                <button 
                    type="button" 
                    data-i18n="booking.btnList.move.value" 
                    class="btn btn-info" 
                    data-bs-target="#moveRoomModal" 
                    data-bs-toggle="modal"
                >  
                    Move Room
                </button>
                <button 
                    type="button" 
                    data-i18n="booking.btnList.extend.value" 
                    class="btn btn-dark" 
                    onclick="openExtendDateModal()"
                    data-bs-target="#extendBookingModal" 
                    data-bs-toggle="modal"
                >
                    Extend Booking
                </button>
            </div>
            <div class="button-group en-font">
                <button type="button" data-i18n="booking.btnList." class="btn btn-success" onclick="roomCheckIn()">Check In</button>
                <button type="button" data-i18n="booking.btnList." class="btn btn-warning" onclick="roomCheckOut()">Check Out</button>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="extendBookingModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" data-i18n="booking.btnList.extend.title"></h1>
        <button type="button" class="btn-close" data-bs-target="#bookingRoomModal" data-bs-toggle="modal"></button>
      </div>
      <div class="modal-body row">
        <div class="col-6">
            <h5 class="fw-bold float-start" data-i18n="booking.btnList.extend.old_checkout"></h5>
            <input 
                type="date" 
                id="old_check_out_date"  
                class="form-control en-font" 
                disabled
            />
        </div>
        <div class="col-6">
            <h5 class="fw-bold float-start" data-i18n="booking.btnList.extend.new_checkout"></h5>
            <input 
                type="date" 
                id="new_check_out_date" 
                onchange="calculateDuration_Total(old_check_out_date, new_check_out_date, 'extend_room_price', 'extend_duration', 'extend_total')"  
                class="form-control en-font" 
                data-error="Select Check In Date"  
                required
            />
        </div>

        <figure class="d-flex pt-4 mb-0 justify-content-between">
            <b class="col-4">
                <span data-i18n="booking.btnList.extend.duration"></span>:
                <label style="color:#fd7e14" >
                    <span id="extend_duration"></span> 
                    <span data-i18n="booking.table.night"></span>
                </label> 
            </b>
            <b class="col-4">
                <span data-i18n="reservation.step2.price"></span>: 
                <label style="color:#fd7e14" class="en-font" id="extend_room_price"></label> 
            </b>
            <b class="col-4">
                <span data-i18n="booking.btnList.extend.total"></span>:
                <label style="color:#fd7e14" id="extend_total" class="en-font"></label> 
            </b>
        </figure>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" data-bs-target="#bookingRoomModal" data-bs-toggle="modal" data-i18n="reservation.progress.btn_back"></button>
        <button class="btn btn-primary" onclick="extendBookingDate()" data-i18n="modal.submit"></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="moveRoomModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" data-i18n="booking.btnList.move.title"></h1>
            <button type="button" class="btn-close" data-bs-target="#bookingRoomModal" data-bs-toggle="modal" onclick="backToBookingModal()"></button>
        </div>
        <div class="modal-body row">
            <article class="col-12">
                <h5 class="mb-2 fw-bold float-start" data-i18n="rooms.info.type"></h5>
                <select class="form-control en-font" id="movingRoomType" name="roomType" onchange="getFreeRoomForMoving(this.value)" data-error="Select Room Type" required>
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
                <h5 class="mb-2 fw-bold float-start" data-i18n="booking.table.room"></h5>
                <select 
                    class="form-control en-font" 
                    id="availableRooms" 
                    name="available_room_id" 
                >
                    <option selected disabled > Please select the room no. </option>
                </select>
            </article>

            <article class="col-lg-12 mt-4">
                <h5 class="mb-2 fw-bold float-start" data-i18n="booking.info.memo"></h5>
                <textarea id="movingRoomMemo" class="form-control" placeholder="Write memo..."></textarea>
            </article>

            <figure class="d-flex pt-4 mb-0 justify-content-between">
                <b class="col-4 d-flex flex-column">
                    <span data-i18n="booking.btnList.move.duration"></span>
                    <label style="color:#fd7e14">
                        <span class="en-font" id="remaining_days"> 0 </span> 
                        <span data-i18n="booking.table.night"></span>
                    </label>
                </b>
                <b class="col-4 d-flex flex-column">
                    <span data-i18n="booking.btnList.move.price"></span> 
                    <span style="color:#fd7e14" class="en-font" id="origin_price">  0 KIP</span> 
                </b>
                <b class="col-4 d-flex flex-column">
                    <span data-i18n="booking.btnList.move.charge"></span> 
                    <span class="text-primary en-font" id="movingExtraFee"> 0 KIP </span> 
                </b>
            </figure>

        </div>
      <div class="modal-footer">
        <button class="btn btn-info" data-i18n="reservation.progress.btn_back" data-bs-target="#bookingRoomModal" data-bs-toggle="modal" onclick="backToBookingModal()"></button>
        <button class="btn btn-success" id="btnMoveRoom" data-i18n="booking.btnList.move.value" onclick="moveRoom()"></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cancelModal" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" data-i18n="booking.info.memo"> Cancel Memo</h1>
        <button type="button" class="btn-close" data-bs-target="#bookingRoomModal" data-bs-toggle="modal"></button>
      </div>
      <div class="modal-body">
        <textarea id="cancelMemo" class="form-control en-font" placeholder="Write memo..."></textarea>
      </div>
      <div class="modal-footer">
        <button 
            class="btn btn-info" 
            data-i18n="reservation.progress.btn_back" 
            data-bs-target="#bookingRoomModal" 
            data-bs-toggle="modal" 
            onclick="backToBookingModal()"
        ></button>
        <button class="btn btn-danger" id="btnCancelBooking" onclick="cancelBooking()" data-i18n="booking.btnList.cancel"></button>
      </div>
    </div>
  </div>
</div>