<form class="container my-4" onsubmit="registerBooking(event)" method="post">
    <main class="bg-white shadow  h-100 p-3">
        <h2 class="reservation_title pb-2 mb-4">
           <b> Room Information </b>
        </h2>
        <div class="row mb-2">
            <section class="form-group my-4 col-lg-6">
                <h5 style="float:left"><b> Room Type</b></h5>
                <select class="form-control" id="ReserverRoomType" name="roomType" onchange="fetchFreeRoom(this.value)" data-error="Select Room Type" required>
                    <option selected disabled> Select the Room Type</option>
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
            </section>

            <section class="col-lg-6 my-4 form-group">
                <h5 style="float:left" class="mb-2"><b>Room No.</b> </h5>
                <select 
                    class="form-control" 
                    id="availableRooms" 
                    name="available_room_id" 
                    data-error="Select Room Type" 
                    required
                >
                </select>
            </section>

            <section class="col-6 mt-4 mb-5 row p-0">
                <article class="col-lg-6 form-group">
                    <h5 style="float:left"><b> Check In Date</b></h5>
                    <input 
                        type="date" 
                        id="check_in_reserve" 
                        onchange="getDuration(check_in_reserve, check_out_reserve, 'booking_room_price', 'booking_duration', 'booking_total')"  
                        class="form-control" 
                        data-error="Select Check In Date"  
                        required
                    />
                </article>
    
                <article class="col-lg-6 form-group">
                    <h5 style="float:left"> <b>Check Out Data</b></h5>
                    <input 
                        type="date" 
                        id="check_out_reserve" 
                        onchange="getDuration(check_in_reserve, check_out_reserve, 'booking_room_price', 'booking_duration', 'booking_total')" 
                        class="form-control" 
                        min="<?php echo date("Y-m-d"); ?>" 
                        data-error="Select Check Out Date" 
                        required
                    />
                </article>
                
                <article class="col-lg-12 mt-4 d-flex align-items-start">
                    <input type="checkbox" class="btn-check" id="cbPayment">
                    <label class="btn btn-outline-primary" for="cbPayment">Customer has already paid the fee</label>
                </article>
            </section>


            <section class="col-lg-6 mt-4 mb-5 form-group">
                <h5 style="text-align: left;"><b>Customers</b></h5>
                <div class="d-flex">
                    <select id="custSelector" class="form-control me-3" onchange="custSelect(this.value)">
                        <option value="0" selected disabled> Select the Customers</option>
                        <?php 
                            $sql ="SELECT * FROM `customer`";
                            $result=$conn-> query($sql);
                            while($row=$result-> fetch_assoc()){
                                $fullName = $row["cust_name"] . ' ' . $row["cust_firstname"];
                                $value = $row['cust_id'] . '/' . $fullName;
                        ?>        
                            <option value='<?php echo $value ?>'>
                                <?php echo $fullName?>
                            </option>
                        <?php } ?>
                    </select>
                    <button type="button" class="btn btn-success" onclick="addNewCustomer()" data-bs-toggle="modal" data-bs-target="#customerModal">New</button>
                </div>

                <div class="col-12 mt-4 d-flex flex-wrap booking-customer-list">
                </div>
            </section>

            <figure class="d-flex pt-4 mb-0 justify-content-between" style="border-top:1px solid grey">
                <h5 >
                    <b>Duration: <label style="color:#fd7e14" id="booking_duration"> 0 Day </label> </b>
                </h5>
                <h5>
                    <b>Price: <label style="color:#fd7e14" id="booking_room_price"> 0 KIP </label> </b>
                </h5>
                <h5>
                    <b>Total Amount: <label style="color:#fd7e14" id="booking_total"> 0 KIP </label> </b>
                </h5>
            </figure>
        </div>
    </main>

    <main class="bg-white shadow  h-100 p-3 my-4 d-flex" >
        <button type="submit" class="btn btn-lg btn-success w-100 mx-3">Submit</button>
        <button type="reset" id="resetBookingBtn" onclick="resetBooking()" class="btn btn-lg btn-danger w-100 mx-3">Reset</button>
    </main>
</form>


    <!-- modal for customer -->

<div class="modal" id="customerModal" data-id=<?php echo uniqid("c");?> data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="customerModalTitle"></h1>
                <button type="button" id="custModalClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="customerForm" onsubmit="customerSubmit(event)">
                <div class="modal-body">
                    <div class="container-fluid mb-4" > 
                        <div class="row">
                            <div class="col-6 mb-4">
                                <label style="float: left;" class="mb-1"><b> Name</b></label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="cust_name" 
                                    name="cust_name" 
                                    placeholder="Name..." 
                                    data-error="Type Name" 
                                    required
                                />
                            </div>
                            <div class="col-6 mb-4">
                                <label style="float: left;" class="mb-1"><b> Family Name</b></label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="cust_fname" 
                                    name="cust_fname" 
                                    placeholder="Family Name..." 
                                    data-error="Type Family Name" 
                                    required
                                />
                            </div>
                            <div class="col-lg-6">
                                <h5 style="float:left"><b> Birthday </b></h5>
                                <input 
                                    type="date" 
                                    id="cust_bd" 
                                    class="form-control" 
                                    data-error="Select Birthday"  
                                    required
                                />
                            </div>
                            <div class="col-6 mb-4">
                                <label style="float: left;" class="mb-1"><b>Contact</b></label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="cust_contact" 
                                    name="cust_contact" 
                                    placeholder="Contact..." 
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                />
                            </div>
                            <div class="col-6 mb-4">
                                <label style="float: left;" class="mb-1"><b>Email</b></label>
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    id="cust_email" 
                                    name="cust_email" 
                                    placeholder="Email..." 
                                />
                            </div>
                            <div class="col-6 mb-4">
                                <label style="float: left;" class="mb-1"><b> ID/Passport</b></label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="cust_id_passport" 
                                    name="cust_id_passport" 
                                    placeholder="ID/Passport" 
                                    data-error="Type ID / Passport" 
                                    required
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="closeCustModal()" class="btn btn-secondary" >Close</button> 
                        <button type="submit" id="btnCustInfoSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>