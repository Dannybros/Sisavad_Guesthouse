<form class="container my-4" onsubmit="registerBooking(event)" method="post" id="reserveForm">
    <main class="bg-white shadow h-100 p-3">
        <h2 class="reservation_title pb-2 mb-4 fw-bold" data-i18n="reservation.title">
        </h2>
        <!-- Stepper -->
        <div class="accordion mx-2 " id="accordionExample">
            <div class="steps">
                <progress id="progress" value="0" max="100"></progress>
                <div class="step-item d-flex flex-column">
                    <button class="step-button text-center en-font" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" disabled>
                        1
                    </button>
                    <div class="step-title" data-i18n="reservation.progress.step1">
                    </div>
                </div>
                <div class="step-item">
                    <button class="step-button text-center en-font collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" disabled>
                        2
                    </button>
                    <div class="step-title" data-i18n="reservation.progress.step2">
                    </div>
                </div>
                <div class="step-item">
                    <button class="step-button text-center en-font collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" disabled>
                        3
                    </button>
                    <div class="step-title" data-i18n="reservation.progress.step3">
                    </div>
                </div>
            </div>
            
            <section id="collapseOne" class="collapse show" data-bs-parent="#accordionExample">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-6 mb-4">
                            <label class="float-start fw-bold mb-1" data-i18n="customer.name"></label>
                            <input 
                                type="text" 
                                class="form-control en-font" 
                                id="cust_name" 
                                name="cust_name" 
                                placeholder="Name..." 
                            />
                        </div>
                        <div class="col-6 mb-4">
                            <label class="float-start fw-bold mb-1" data-i18n="customer.surname"></label>
                            <input 
                                type="text" 
                                class="form-control en-font" 
                                id="cust_fname" 
                                name="cust_fname" 
                                placeholder="Family Name..." 
                            />
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="float-start fw-bold mb-1" data-i18n="customer.bd"></label>
                            <input 
                                type="date" 
                                id="cust_bd" 
                                class="form-control en-font" 
                            />
                        </div>
                        <div class="col-6 mb-4">
                            <label class="float-start fw-bold mb-1" data-i18n="customer.phone"></label>
                            <input 
                                type="text" 
                                class="form-control en-font" 
                                id="cust_contact" 
                                name="cust_contact" 
                                placeholder="Contact..." 
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            />
                        </div>
                        <div class="col-6 mb-4">
                            <label class="float-start fw-bold mb-1" data-i18n="customer.email"></label>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="cust_email" 
                                name="cust_email" 
                                placeholder="Email..." 
                            />
                        </div>
                        <div class="col-6 mb-4 en-font">
                            <label class="float-start fw-bold mb-1" data-i18n="customer.passport"></label>
                            <input 
                                type="text" 
                                class="form-control en-font" 
                                id="cust_id_passport" 
                                name="cust_id_passport" 
                                placeholder="ID/Passport" 
                            />
                        </div>
                        <div class="d-flex justify-content-start px-2">
                            <button type="button" data-i18n="modal.reset" onclick="resetCustomerInfo()" class="btn btn-secondary me-2"> Reset</button> 
                            <button type="button" data-i18n="customer.btn_add" onclick="customerManage()" id="btnCustInfoSubmit" class="btn btn-success" data-type="new" data-id="new"> Add New Customer </button>
                        </div>

                        <div class="border-top my-4"></div>

                        <article class="col-6">
                            <h5 class="text-start fw-bold" data-i18n="reservation.step1.selector"></h5>
                                <select id="customerSelector" class="form-control me-3" onchange="selectCustomer(this.value)">
                                    <option value="0" selected disabled data-i18n="reservation.step1.selector"></option>
                                    <?php 
                                        $sql ="SELECT * FROM `customer`";
                                        $result=$conn-> query($sql);
                                        while($row=$result-> fetch_assoc()){
                                            $fullName = $row["cust_name"] . ' ' . $row["cust_firstname"];
                                            $value = $row['cust_id'] . '/' . $fullName;
                                    ?>        
                                        <option value='<?php echo $value ?>' class="en-font">
                                            <?php echo $fullName?>
                                        </option>
                                    <?php } ?>
                                </select>
                        </article>
                        <div class="col-6 mt-4 d-flex flex-wrap booking-customer-list"> </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end w-100 pe-2 mt-3 gap-3">
                    <button type="button" class="btn btn-primary text-uppercase" onclick="goToSecondStep()" data-i18n="reservation.progress.btn_next">
                        NEXT
                    </button>
                </div>
            </section>

            <section id="collapseTwo" class="collapse" data-bs-parent="#accordionExample">
                <div class="card">
                    <div class="card-body row pt-4">
                        <article class="col-lg-3 form-group en-font">
                            <label class="float-start fw-bold">Check In Date</label>
                            <input 
                                type="date" 
                                id="check_in_date"  
                                class="form-control" 
                                disabled
                            />
                        </article>
                        <article class="col-lg-3 form-group en-font">
                            <label class="float-start fw-bold"> Check Out Data</label>
                            <input 
                                type="date" 
                                id="check_out_date" 
                                class="form-control" 
                                min="<?php echo date("Y-m-d"); ?>" 
                                disabled
                            />
                        </article>

                        <article class="col-6">
                            <label class="float-start fw-bold" data-i18n="reservation.step2.ranger"> Date Ranger </label>
                            <input type="text" role="button" class="col-6 form-control en-font" name="datefilter" value="" placeholder="CHOOSE DATES" data-error="Please choose dates"/>
                        </article>

                        <article class="col-6 mt-4">
                            <label class="float-start fw-bold" data-i18n="rooms.info.type"> Room Type </label>
                            <select class="form-control" id="reserveRoomType" name="roomType" onchange="fetchFreeRoom(this.value)" data-error="Select Room Type" required>
                                <option selected disabled data-i18n="rooms.info.select"> Select the Room Type</option>
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
                            <label class="float-start fw-bold" data-i18n="reservation.step2.room">Room No.</label>
                            <select 
                                class="form-control en-font" 
                                id="availableRooms" 
                                name="available_room_id" 
                                data-error="Select Room Type" 
                            >
                            </select>
                        </article>
                        
                        <div class="border-top my-4"></div>
                        
                        <figure class="d-flex justify-content-between fw-bold">
                            <h5>
                                <span data-i18n="reservation.step2.duration"></span>:
                                <label style="color:#fd7e14">
                                    <span id="booking_duration"></span> 
                                    <span data-i18n="booking.table.night"></span>
                                </label> 
                            </h5>
                            <h5>
                                <span data-i18n="reservation.step2.price"></span>: 
                                <label style="color:#fd7e14" class="en-font" id="booking_room_price"> 0 KIP</label> 
                            </h5>
                            <h5>
                                <span data-i18n="reservation.step2.total"></span>: 
                                <label style="color:#fd7e14" class="en-font" id="booking_total"> 0 KIP</label> 
                            </h5>
                        </figure>
                    </div>
                </div>
                <div class="d-flex justify-content-end w-100 pe-2 mt-3 gap-3">
                    <button type="button" id="btnStepOne" class="btn btn-secondary text-uppercase" onclick="stepClick(0, 0)" data-bs-toggle="collapse" data-bs-target="#collapseOne" data-i18n="reservation.progress.btn_back">
                        BACK
                    </button>
                    <button disabled id="secondStepBtn" type="button" class="btn btn-primary text-uppercase" onclick="goToFinalStep()" data-bs-toggle="collapse" data-bs-target="#collapseThree" data-i18n="reservation.progress.btn_next">
                        NEXT
                    </button>
                </div>
            </section>

            <section id="collapseThree" class="collapse" data-bs-parent="#accordionExample">
                <div class="card" id="booking_bill">
                    <div class="card-body row px-5 ">
                        <div class="bg-success text-light p-3">
                            <h1 class="mb-4 text-uppercase" data-i18n="reservation.step3.title">HOTEL RECEIPT</h1> 
                            <p class="m-0 en-font">4162 Masonic Drive, Broadview, MT, 590104</p>
                            <p class="m-0 en-font">(856)2054839483 - info@124hotel.com - kkyeowjdh@gmail.com</p>
                        </div>
                        <div class="bg-warning-subtle w-100" style="height: 10px;"></div>
                        <div class="bg-primary-subtle w-100" style="height: 10px;"></div>

                        <div class="d-flex justify-content-between align-items-center p-0 pb-2 mt-4 border-bottom border-dark">
                            <div class="px-3 bg-warning fs-4 py-2 bg-opacity-50 en-font">
                                <span data-i18n="reservation.step3.subtitle"> Booking ID</span>
                                (<span id="booking_id"> b39203d820e </span>)
                            </div>
                            <div class="d-flex align-items-center me-3">
                                <span class="fs-6 fw-bold me-3" data-i18n="reservation.step3.employee"> Employee </span>
                                <select id="employeeSelector" class="form-control fs-6">
                                    <option selected disabled data-i18n="reservation.step3.select"> Select the Employee</option>
                                    <?php 
                                        $sql ="SELECT * FROM `employee`";
                                        $result=$conn-> query($sql);
                                        while($row=$result-> fetch_assoc()){
                                            $id = $row["emp_ID"];
                                            $name = $row["emp_Name"];
                                    ?>        
                                        <option value='<?php echo $id ?>'>
                                            <?php echo $name?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <section class="col-4 border-end">
                            <article class="w-100 px-4 py-3 text-start ">
                                <label class="mb-2 fw-bold" data-i18n="customer.name">Name</label>
                                <h6 class="mb-0 border-bottom en-font" id="bill_customer_name"></h6>
                            </article>

                            <article class="w-100 px-4 py-3 text-start">
                                <label class="mb-2 fw-bold" data-i18n="customer.email"> Email </label>
                                <h6 class="mb-0 border-bottom en-font" id="bill_customer_email"></h6>
                            </article>
                            
                            <article class="w-100 px-4 py-3 text-start ">
                                <label class="mb-2 fw-bold" data-i18n="customer.phone"> Phone </label>
                                <h6 class="mb-0 border-bottom en-font" id="bill_customer_phone"></h6>
                            </article>

                            <article class="w-100 px-4 py-3 text-start ">
                                <label class="mb-2 fw-bold" data-i18n="customer.passport"> ID / Passport </label>
                                <h6 class="mb-0 border-bottom en-font" id="bill_customer_passport"></h6>
                            </article>
                        </section>

                        <section class="col-8 row">
                            <article class="col-6 px-4 py-3 text-start en-font">
                                <label class="mb-2"><b> Check In Date </b> </label>
                                <h6 class="mb-0 border-bottom" id="bill_check_in"></h6>
                            </article>

                            <article class="col-6 px-4 py-3 text-start en-font">
                                <label class="mb-2"><b> Check Out Date </b> </label>
                                <h6 class="mb-0 border-bottom" id="bill_check_out"></h6>
                            </article>

                            <article class="col-6 px-4 py-2">
                                <label style="float:left" class="mb-2 fw-bold" data-i18n="booking.info.payment.status.title"> Payment Status </label>
                                <select 
                                    class="form-control" 
                                    id="paymentStatusSelector"
                                    data-error="Select Payment Option" 
                                    onchange="payStatusChange(this.value)"
                                    required
                                >
                                    <option selected disabled data-i18n="booking.info.payment.status.default"> --- Choose Status --- </option>
                                    <option value="Paid" data-i18n="payment.paid"> Paid</option>
                                    <option value="Unpaid" data-i18n="payment.unpaid"> Unpaid</option>
                                    <option value="Deposit" data-i18n="payment.deposit"> Deposit</option>
                                </select>
                            </article>

                            <article class="col-6 px-4 py-2">
                                <label style="float:left" class="mb-2 fw-bold" data-i18n="booking.info.payment.option.title">Payment Option </label>
                                <select 
                                    class="form-control" 
                                    id="paymentOptionSelector"
                                    onchange="payOptionChange(this.value)"
                                >
                                    <option selected disabled data-i18n="booking.info.payment.option.default"> --- Choose Payment Option --- </option>
                                    <option value="Cash" class="en-font"> Cash</option>
                                    <option value="OnePay" class="en-font"> OnePay </option>
                                </select>
                            </article>
                            
                            <article class="col-12 invisible p-0" id="onePayBill">
                                <div class="px-4 py-3 text-start">
                                    <label class="mb-2 fw-bold" data-i18n="reservation.step3.ref_code"></label>
                                    <div class="refCodeBox form-control en-font">
                                        <ul id="refCodes" onclick="refListClick(event)"></ul>
                                        <input type="text" id="refCodeInput" onkeydown="fillCode(event)" placeholder="OnePay codes...">
                                    </div>
                                </div>
                            </article>
                        </section>
                         
                        <section class="col-12 px-4">
                            <table class="table table-info">
                                <thead>
                                    <tr>
                                        <th scope="col" data-i18n="rooms.info.name">Room Number</th>
                                        <th scope="col" data-i18n="booking.table.duration">Duration</th>
                                        <th scope="col" data-i18n="rooms.info.price">Price Per Night</th>
                                        <th scope="col" data-i18n="booking.info.total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="en-font">
                                        <td id="bill_room"></td>
                                        <td id="bill_room_duration"></td>
                                        <td id="bill_room_price"></td>
                                        <td id="bill_room_total"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3 text-uppercase" data-i18n="booking.info.total">TOTAL:</th>
                                        <td id="bill_total" class="en-font"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>  
                <div class="d-flex justify-content-end w-100 pe-2 mt-3 gap-3">
                    <button type="button" 
                        data-i18n="reservation.progress.btn_back" class="btn btn-secondary text-uppercase" onclick="stepClick(50, 1)" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    >
                        BACK
                    </button>
                    <button type="submit" class="btn btn-success text-uppercase mx-2" data-i18n="modal.submit">Submit</button>
                </div>
            </section>
        </div>
    </main>
</form>
