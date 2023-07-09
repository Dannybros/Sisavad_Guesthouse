<form class="container my-4" onsubmit="registerBooking(event)" method="post">
    <main class="bg-white shadow h-100 p-3">
        <h2 class="reservation_title pb-2 mb-4">
           <b > Room Information </b>
        </h2>
        <!-- Stepper -->
        <div class="accordion mx-2 " id="accordionExample">
            <div class="steps">
                <progress id="progress" value="0" max="100"></progress>
                <div class="step-item d-flex flex-column">
                    <button class="step-button text-center" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" disabled>
                        1
                    </button>
                    <div class="step-title">
                        Customer Info
                    </div>
                </div>
                <div class="step-item">
                    <button class="step-button text-center collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" disabled>
                        2
                    </button>
                    <div class="step-title">
                        Booking Date
                    </div>
                </div>
                <div class="step-item">
                    <button class="step-button text-center collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        3
                    </button>
                    <div class="step-title">
                        Reserve
                    </div>
                </div>
            </div>
            
            <section id="collapseOne" class="collapse show" data-bs-parent="#accordionExample">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-6 mb-4">
                            <label style="float: left;" class="mb-1"><b> Name</b></label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="cust_name" 
                                name="cust_name" 
                                placeholder="Name..." 
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
                            />
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label style="float:left"><b> Birthday </b></label>
                            <input 
                                type="date" 
                                id="cust_bd" 
                                class="form-control" 
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
                            <label style="float: left;" ><b>Email</b></label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="cust_email" 
                                name="cust_email" 
                                placeholder="Email..." 
                            />
                        </div>
                        <div class="col-6 mb-4">
                            <label style="float: left;"><b> ID/Passport</b></label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="cust_id_passport" 
                                name="cust_id_passport" 
                                placeholder="ID/Passport" 
                            />
                        </div>
                        <div class="modal-footer d-flex justify-content-start px-2">
                            <button type="button" onclick="resetCustomerInfo()" class="btn btn-secondary me-2"> Reset</button> 
                            <button type="button" onclick="customerManage()" id="btnCustInfoSubmit" class="btn btn-success"  data-id="new"> Add New Customer </button>
                        </div>

                        <div class="border-top my-4"></div>

                        <article class="col-6">
                            <h5 style="text-align: left;"><b>Select Customers</b></h5>
                                <select id="customerSelector" class="form-control me-3" onchange="selectCustomer(this.value)">
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
                        </article>
                        <div class="col-6 mt-4 d-flex flex-wrap booking-customer-list"> </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end w-100 pe-2 mt-3 gap-3">
                    <button type="button" class="btn btn-primary" onclick="goToSecondStep()">
                        NEXT
                    </button>
                </div>
            </section>

            <section id="collapseTwo" class="collapse" data-bs-parent="#accordionExample">
                <div class="card">
                    <div class="card-body row pt-4">
                        <article class="col-lg-3 form-group">
                            <h5 style="float:left"><b> Check In Date</b></h5>
                            <input 
                                type="date" 
                                id="check_in_date"  
                                class="form-control" 
                                disabled
                            />
                        </article>
                        <article class="col-lg-3 form-group">
                            <h5 style="float:left"> <b>Check Out Data</b></h5>
                            <input 
                                type="date" 
                                id="check_out_date" 
                                class="form-control" 
                                min="<?php echo date("Y-m-d"); ?>" 
                                disabled
                            />
                        </article>

                        <article class="col-6">
                            <h5 style="float:left"><b> Date Ranger</b></h5>
                            <input type="text" class="col-6 form-control" name="datefilter" value="" placeholder="CHOOSE DATES" data-error="Please choose dates"/>
                        </article>

                        <article class="col-6 mt-4">
                            <h5 style="float:left"><b> Room Type</b></h5>
                            <select class="form-control" id="reserveRoomType" name="roomType" onchange="fetchFreeRoom(this.value)" data-error="Select Room Type" required>
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

                        <article class="col-lg-6 mt-4">
                            <h5 style="float:left" class="mb-2"><b>Room No.</b> </h5>
                            <select 
                                class="form-control" 
                                id="availableRooms" 
                                name="available_room_id" 
                                data-error="Select Room Type" 
                                required
                            >
                            </select>
                        </article>
                        
                        <div class="border-top my-4"></div>
                        
                        <figure class="d-flex justify-content-between">
                            <h5 >
                                <b>Duration: <label style="color:#fd7e14" id="booking_duration"> 0 Night </label> </b>
                            </h5>
                            <h5>
                                <b>Price: <label style="color:#fd7e14" id="booking_room_price"> 0 KIP </label> </b>
                            </h5>
                            <h5>
                                <b>Total Amount: <label style="color:#fd7e14" id="booking_total"> 0 KIP </label> </b>
                            </h5>
                        </figure>
                    </div>
                </div>
                <div class="d-flex justify-content-end w-100 pe-2 mt-3 gap-3">
                    <button type="button" id="btnStepOne" class="btn btn-secondary" onclick="stepClick(0, 0)" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        BACK
                    </button>
                    <button disabled id="secondStepBtn" type="button" class="btn btn-primary" onclick="goToFinalStep()" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                        NEXT
                    </button>
                </div>
            </section>

            <section id="collapseThree" class="collapse" data-bs-parent="#accordionExample">
                <div class="card ">
                    <div class="card-body row px-5 ">
                        <div class="bg-success text-light p-3">
                            <h1 class="mb-4">HOTEL RECEIPT</h1> 
                            <p class="m-0">4162 Masonic Drive, Broadview, MT, 590104</p>
                            <p class="m-0">(856)2054839483 - info@124hotel.com - kkyeowjdh@gmail.com</p>
                        </div>
                        <div class="bg-warning-subtle w-100" style="height: 10px;"></div>
                        <div class="bg-primary-subtle w-100" style="height: 10px;"></div>
                        <h3 class="text-start p-0 mt-4">
                            <div class="col-3 bg-warning ps-4 bg-opacity-50">Bill To</div>
                        </h3>
                        <section class="col-4">
                            <article class="w-100 px-4 py-3 text-start ">
                                <h5 class="mb-2"><b> Name </b> </h5>
                                <h6 class="mb-0 border-bottom" id="bill_customer_name"></h6>
                            </article>
                            <article class="w-100 px-4 py-3 text-start">
                                <h5 class="mb-2"><b> Email </b> </h5>
                                <h6 class="mb-0 border-bottom" id="bill_customer_email"></h6>
                            </article>
                            <article class="w-100 px-4 py-3 text-start ">
                                <h5 class="mb-2"><b> Phone </b> </h5>
                                <h6 class="mb-0 border-bottom" id="bill_customer_phone"></h6>
                            </article>
                            <article class="w-100 px-4 py-3 text-start ">
                                <h5 class="mb-2"><b> ID / Passport </b> </h5>
                                <h6 class="mb-0 border-bottom" id="bill_customer_passport"></h6>
                            </article>
                        </section>

                        <section class="col-8 row">
                            <article class="col-6 px-4 py-3 text-start">
                                <h5 class="mb-2"><b> Check In Date </b> </h5>
                                <h6 class="mb-0 border-bottom" id="bill_check_in"></h6>
                            </article>
                            <article class="col-6 px-4 py-3 text-start">
                                <h5 class="mb-2"><b> Check Out Date </b> </h5>
                                <h6 class="mb-0 border-bottom" id="bill_check_out"></h6>
                            </article>
                            <article class="col-6 px-4 py-2">
                                <h5 style="float:left" class="mb-2"><b> Payment Status </b> </h5>
                                <select 
                                    class="form-control" 
                                    id="paymentStatusSelector"
                                    data-error="Select Payment Option" 
                                    required
                                >
                                    <option selected disabled> --- Choose Status --- </option>
                                    <option value="Paid"> Paid</option>
                                    <option value="Unpaid"> Unpaid</option>
                                    <option value="Deposit"> Deposit</option>
                                </select>
                            </article>
                            <article class="col-6 px-4 py-2">
                                <h5 style="float:left" class="mb-2"><b> Payment Option </b> </h5>
                                <select 
                                    class="form-control" 
                                    id="paymentOptionSelector"
                                >
                                    <option selected disabled> --- Choose Payment Option --- </option>
                                    <option value="Cash"> Cash</option>
                                    <option value="OnePay"> OnePay </option>
                                </select>
                            </article>

                            <table class="table table-info col-12">
                                <thead>
                                    <tr>
                                        <th scope="col">Room Number</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Price Per Night</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="bill_room"></td>
                                        <td id="bill_room_duration"></td>
                                        <td id="bill_room_price"></td>
                                        <td id="bill_room_total"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">TOTAL:</th>
                                        <td id="bill_total">s</td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>  
                <div class="d-flex justify-content-end w-100 pe-2 mt-3 gap-3">
                    <button type="button" class="btn btn-secondary" onclick="stepClick(50, 1)" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        BACK
                    </button>
                    <button type="submit" class="btn btn-success mx-2">Submit</button>
                </div>
            </section>

        </div>
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
                        <div class="row" >
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