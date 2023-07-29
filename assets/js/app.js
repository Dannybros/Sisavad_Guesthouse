var today = new Date();
var year = today.getFullYear();
var month = today.getMonth() + 1;

var schedule_month = document.getElementById("schedule-month");
var cal_header = document.getElementById('calender_header');
var cal_body = document.getElementById("calender_body");
var schedulePage = document.getElementById('schedule');

var addCustomerTitle = "Add New Customer";
var editCustomerTitle = "Edit Customer";

const customerList = document.querySelector('.booking-customer-list');
const customerSelector = document.getElementById("customerSelector");

// alert 

function appendAlert(message, type){
    var content = document.getElementById("alert-box");
    const wrapper = document.createElement('div')
    wrapper.classList.add('alertInfo');
    wrapper.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show alertInfo" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `

    content.append(wrapper)

    setTimeout(function() {
        $(".alert").alert('close');
    }, 2500);
    
}

function reportBtnClick(){
    $(".icon-rotate").toggleClass("down");
}

// schedule

function clearCalender(){
    cal_header.innerHTML = '';
    cal_body.innerHTML="";
}

function twoDigitNumber(num){
    let result = num.toLocaleString('en-US', {
        minimumIntegerDigits: 2,
        useGrouping: false
    })
    return result;
}

function getTotalDays(year, month){
    return new Date(year, month, 0).getDate();
}

function goPrevMonth(){
    if(month <= 1){
        year = year - 1;
        month = 12;
    }else month = month - 1;

    clearCalender();
    createSchedule();
}

function goNextMonth(){
    if(month >= 12){
        year = year + 1;
        month = 1;
    }else month = month + 1;

    clearCalender();
    createSchedule();
}

function createCalender(rooms){

    schedule_month.innerHTML = twoDigitNumber(month) + " - " + year;

    var totalDays  = getTotalDays(year, month);
    
    function insertDates(parent, element, name, id){

        const isTbody = element==="th"? false : true;

        const table_tr = document.createElement("tr");
        const row_head = document.createElement("th");
        
        row_head.setAttribute("scope", !isTbody? "col" : "row");
        row_head.innerHTML=`
            ${name} <b class="fs-base fw-medium" style="width:20px"></b>
        `;
        table_tr.appendChild(row_head);
        
        for (let i = 1; i <= totalDays; i++){
            const date = document.createElement(element);

            if(isTbody){
                
                date.style.position = "relative";
                date.classList.add("bg-opacity-75");
                date.classList.add("bg-white");
                date.setAttribute("id", id + "-" + i);
               
            }else{
                date.innerHTML = twoDigitNumber(i)
                date.setAttribute("scope", "col");
                
                if(today.getFullYear()=== year && today.getMonth()===month-1 && today.getDate()===i){
                    date.classList.add("bg-info");
                }
            }
            table_tr.appendChild(date);
        }

        parent.appendChild(table_tr);
    }

    insertDates(cal_header, "th", "#", null);

    rooms.map((room)=>{
        insertDates(cal_body, "td", room.name, room.id)
    })
}

function createSchedule(){
    $.ajax({
        url:`./controllers/getRoom.php?all`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            console.log(data);
            let roomNames = data.map(a => ({id: a.id, name:a.name, type:a.type}));
            createCalender(roomNames);
            getBookingSchedule();
        }   
    })
}

function getBookingSchedule(){
    $.ajax({
        url:`./controllers/getRoomLog.php?all`,
        type:"POST",
        data:{
            year:year,
            month:month
        },
        dataType:"JSON",
        success: function(data){
            insertDataToSchedule(data);
        }   
    })
}

function groupData(data){
    const groupedData = data.reduce((acc, cur) => {
        if (acc.find(item => item.bookingID === cur.b_id)) {
            const existingItem = acc[acc.findIndex(item => item.bookingID === cur.b_id)].action;
            existingItem.push({
                roomID:cur.roomID,
                oldRoomID:cur.oldRoomID,
                movement: cur.movement,
                movement_time: cur.movement_time,
                memo:cur.memo,
            });
        } else {
            acc.push({
                bookingID:cur.b_id,
                customer:JSON.parse(cur.c_id),
                dateIn:cur.dateIn,
                dateOut:cur.dateOut,
                duration:cur.duration,
                payment:cur.payment,
                status:cur.bStatus,
                action:[{
                    roomID:cur.roomID,
                    oldRoomID:cur.oldRoomID,
                    movement: cur.movement,
                    movement_time: cur.movement_time,
                    memo:cur.memo,
                }]
            });
        }
        
        return acc;
    }, []);

    return groupedData;
}

function insertDataToSchedule(data){
    const groupedData = groupData(data)

    groupedData.map((booking, i)=>{
        var dateOut, dateIn, bookingNo = i + 1;
        const dateInMonth = +booking.dateIn.split('-')[1];
        const dateOutMonth = +booking.dateOut.split('-')[1];

        dateIn = dateInMonth < month ? 1 : +booking.dateIn.split('-')[2];
        dateOut = dateOutMonth === month ? +booking.dateOut.split('-')[2] : getTotalDays(year, month);
        
        putLabelInCalender(dateIn, dateOut, booking, bookingNo)
    })
}

function styleCalenderBooking(dateID, remove, add, bookingID){
    const bk_date = document.getElementById(dateID);
    bk_date.classList.remove(`bg-${remove}`);
    bk_date.classList.add(`bg-${add}`);
     
    addInfoToBookingDate(bk_date, bookingID);
}

function addInfoToBookingDate(el, bookingID){
    el.setAttribute("data-bs-toggle", "modal");
    el.setAttribute("data-bs-target", "#bookingRoomModal");
    el.onclick= function(){
        viewBookingInfo(bookingID, 'calender');
    }
}

function createNumberBooking(id, bookingNo, paid){
    var paidIcon = paid==="Paid"? '' : '<i class="fa fa-money" aria-hidden="true"></i>'
    document.getElementById(id).innerHTML+=`
        <div class="position-absolute top-0 start-0 w-100 px-1 text-white d-flex justify-content-between align-items-center" style="font-size: 11px;"> 
            ${bookingNo} 
            ${paidIcon}
        </div>
    `;
}

function removeNumberBooking(id){
    var bk_date = document.getElementById(`${id}`);
    bk_date.children[0].remove();
}

function putLabelInCalender(dateIn, dateOut, booking, bookingNo){

    const actions = booking.action;
    const paid = booking.payment;
    
    const movedAction = actions.find(action=> action.movement==="Moved") || null;

    if(booking.status==="Cancelled") return;

    actions.map((action)=>{
        const roomID = action.roomID;
        const movement = action.movement;
        const timeMonth = +action.movement_time.split('-')[1];
        const timeDate = +action.movement_time.split('-')[2];
        
        const ball = document.createElement('div');
        ball.classList.add("calender-sticker");

        if(movement==="Reserved"){
            for(var i = dateIn; i<=dateOut; i++){
                const id = roomID + '-' + i;
                styleCalenderBooking(id, "white", "warning", booking.bookingID);
                createNumberBooking(id, bookingNo, paid);
            }
        }

        if(movement==="Checked In"){
            for(var i = dateIn; i<=dateOut; i++){
                const id = roomID + '-' + i;
                styleCalenderBooking(id, "warning", "primary", booking.bookingID);
            }

            ball.classList.add('bg-light');
        }
        
        if(movement ==="Moved"){

            //remove future reserved dates of old room
            for(var i = timeDate; i<=dateOut; i++){
                const id = action.oldRoomID + '-' + i;
                styleCalenderBooking(id, "primary", "white");
                removeNumberBooking(id);
            }  

            // add dates for moved room
            for(var i = timeDate; i<=dateOut; i++){
                const id = roomID + '-' + i;
                styleCalenderBooking(id, "white", "primary", booking.bookingID);
                createNumberBooking(id, bookingNo, paid);
            } 

            ball.classList.add('bg-warning');
        }

        if(movement==="Checked Out"){
            if(movedAction){
                const movedDate = +movedAction.movement_time.split('-')[2];
                for(var i = dateIn; i < movedDate; i++){
                    const id = movedAction.oldRoomID + '-' + i;
                    styleCalenderBooking(id, "primary", "success", booking.bookingID);
                }
            }
            for(var i = dateIn; i<=dateOut; i++){
                const id = roomID + '-' + i;
                styleCalenderBooking(id, "primary", "success", booking.bookingID);
            }
            if(timeMonth === month) ball.classList.add('bg-dark');
        }

        document.getElementById(roomID + '-' + timeDate).appendChild(ball);
    })
}

// Reserve

function stepClick(value, index){
    const stepButtons = document.querySelectorAll('.step-button');
    const progress = document.querySelector('#progress');

    progress.setAttribute('value', value);
    
    stepButtons.forEach((item, secindex)=>{
        if(index > secindex){
            item.classList.add('done');
        }
        if(index < secindex){
            item.classList.remove('done');
        }
    })
}

function goToSecondStep(){
    if(customerList.children.length > 0){
        stepClick(50, 1);
        $("#collapseTwo").collapse('show');
    }else{
        alert($.t("reservation.step1.selector"));
        return;
    }
}

function goToFinalStep(){

    function getBookingInfo(){

        var duration = $("#booking_duration").text();
        var price = $("#booking_room_price").text();
        var total = $("#booking_total").text();
        var check_in = $("#check_in_date").val();
        var check_out = $("#check_out_date").val();
        var room = $("#availableRooms").val();

        $("#bill_check_in").text(check_in);
        $("#bill_check_out").text(check_out);
        $("#bill_room").text(room);
        $("#bill_room_duration").text(duration);
        $("#bill_room_price").text(price);
        $("#bill_room_total").text(total);
        $("#bill_total").text(total);
    }

    function getCustomerInfo(){

        var customer_id = customerList.children[0].dataset.id;

        $.ajax({
            url:`./controllers/getCustomer.php?id=${customer_id}`,
            type:"GET",
            dataType:"JSON",
            success: function(data){
                $("#bill_customer_name").text(data.cust_name + " " + data.cust_firstname);
                $("#bill_customer_email").text(data.email);
                $("#bill_customer_phone").text(data.contact);
                $("#bill_customer_passport").text(data.passport);
            }   
        })

    }

    getCustomerInfo();
    getBookingInfo();
    stepClick(100, 2);
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

function formatNumber(num){
    return Number(num).toLocaleString("en-US");
}

function getNextDay(d){
    
    var date = new Date(d.value);

    date.setDate(date.getDate() + 1);
    return formatDate(date);
}

function fetchFreeRoom(id){
    var roomSelector = document.getElementById('availableRooms');
    var duration = $('#booking_duration').text().replace(/[^0-9]/g, "");
    var dateIn = $("#check_in_date").val();
    var dateOut = $("#check_out_date").val();

    if(duration === "0") {
        alert($.t("error.err5"));
        $("#reserveRoomType").val("disabled");
        return;
    }

    console.log(dateIn, dateOut);

    $.ajax({
        url:`./controllers/getRoom.php?free`,
        type:"POST",
        data:{
            type:id,
            checkIn:dateIn,
            checkOut:dateOut,
        },
        dataType:"JSON",
        success: function(data){
            if(data.length >0){
                $("#secondStepBtn").prop('disabled', false);
                roomSelector.innerHTML="<option selected disabled> Please select the room no. </option>";
    
                let price = formatNumber(data[0].price);
                let totalPrice = formatNumber(parseInt(duration) * data[0].price)
    
                $('#booking_room_price').text(price + " KIP");
                $('#booking_total').text(totalPrice + " KIP");
                
                for(var i =0; i<data.length; i++){
                    var display =`
                        <option value='${data[i].id}'>${data[i].name}</option>
                    `;
                    roomSelector.innerHTML+=display;
                }
            }else{
                $("#secondStepBtn").prop('disabled', true);
                $("#reserveRoomType")[0].selectedIndex = 0;
                appendAlert("No Room Availabe. Please Choose Different Room Type !!!", "danger")
            }
        }   
    })
}

function checkDulpicateCustomerList(id){
    
    let result = false;

    for (const child of customerList.children) {
        if(child.id === id) result = true;
    }

    return result

}

function selectCustomer(value){
    customerSelector.value ="0";

    const id = value.split("/")[0];
    const name = value.split("/")[1];    

    if(!checkDulpicateCustomerList(`cl-${id}`)){

        var custBtn = `
            <button type="button" class="btn btn-outline-dark" id='cl-${id}' data-id='${id}'>
                <span onclick="clickCustomerList('${id}')" >${name}</span>
                <em class="fa fa-close text-danger ms-1" onclick="removeCustomerList('cl-${id}')"></em>
            </button>
        `
        customerList.innerHTML+=custBtn;  
    };

}

function removeCustomerList(id){
    document.getElementById(id).remove();
}

function updateCustomerList(id, name){
    const btnID = "cl-" + id;
    document.getElementById(btnID).innerHTML=`
        <span onclick="clickCustomerList('${id}')">${name}</span>
        <em class="fa fa-close text-danger ms-1" onclick="removeCustomerList('${btnID}')"></em>
    `;
}

function updateCustomerSelect(){
    $.ajax({
        url:`./controllers/getCustomer.php?all`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            customerSelector.innerHTML=`<option value="0" selected disabled> Select the Customers</option>`;
            for(var i=0; i<data.length; i++){
                let fullName = data[i].cust_name + " " + data[i].cust_firstname;
                let value = data[i].cust_id + '/' + fullName;
                var option = `<option value='${value}'>${fullName}</option>`

                customerSelector.innerHTML += option;
            }
        }   
    })
}

function clickCustomerList(id){
    $('#btnCustInfoSubmit').text(editCustomerTitle);
    $('#btnCustInfoSubmit').data('type', 'edit');
    $('#btnCustInfoSubmit').removeClass("btn-success");
    $('#btnCustInfoSubmit').addClass("btn-warning");

    function showEditCustInfo(data){
        $('#cust_contact').val(data.contact);
        $('#cust_name').val(data.cust_name);
        $('#cust_fname').val(data.cust_firstname);
        $('#cust_email').val(data.email);
        $('#cust_id_passport').val(data.passport);
        $('#cust_bd').val(data.cust_bd);
        $('#btnCustInfoSubmit').data('id', data.cust_id);
    }

    $.ajax({
        url:`./controllers/getCustomer.php?id=${id}`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            showEditCustInfo(data)
        }   
    })
}

function customerManage(){

    var cust_type = $('#btnCustInfoSubmit').data('type');
    var cust_id = $('#btnCustInfoSubmit').data('id');
    var cust_contact = $('#cust_contact').val();
    var cust_name = $('#cust_name').val();
    var cust_fname = $('#cust_fname').val();
    var email = $('#cust_email').val();
    var passport = $('#cust_id_passport').val();
    var bd = $('#cust_bd').val();

    if(cust_name && cust_contact && email && passport){
        var url= cust_type === 'new' ? "./controllers/addCustomer.php" : `./controllers/editCustomer.php`;

        console.log(url);
    
        $.ajax({
            url:url,
            type:"POST",
            data:{
                cust_id:cust_id,
                cust_contact:cust_contact,
                cust_name:cust_name,
                cust_fname:cust_fname,
                cust_email:email,
                cust_bd:bd,
                cust_id_passport:passport
            },
            success: function(data){
                resetCustomerInfo();
                if(data==='success'){
                    updateCustomerSelect();
                    appendAlert("Customer managed successfully", "success");
                    updateCustomerList(cust_id, cust_name + " " + cust_fname);
                }
                else appendAlert(data, "danger");
            }
        });
    }else alert($.t("rooms.error"))
}

function resetCustomerInfo(){
    $('#cust_contact').val('');
    $('#cust_name').val('');
    $('#cust_fname').val('');
    $('#cust_email').val('');
    $('#cust_id_passport').val('');
    $('#cust_bd').val('');
    $('#btnCustInfoSubmit').data('id', 'new');
    $('#btnCustInfoSubmit').data('type', 'new');
    $('#btnCustInfoSubmit').text(addCustomerTitle);
    $('#btnCustInfoSubmit').addClass("btn-success");
    $('#btnCustInfoSubmit').removeClass("btn-warning");
   
}

function resetBooking(){
    customerList.innerHTML='';
    $('#booking_duration').text('');
    $('#booking_room_price').text('');
    $('#booking_total').text('');
    $('#check_in_date').val('');
    $('#check_out_date').val('');
    $("#reserveRoomType")[0].selectedIndex = 0;
    $("#availableRooms")[0].selectedIndex = 0;
    $("#paymentStatusSelector")[0].selectedIndex = 0;
    $("#paymentOptionSelector")[0].selectedIndex = 0;
    $("#employeeSelector")[0].selectedIndex = 0;
    $('input[name="datefilter"]').daterangepicker({
        value:null
    })
    $('input[name="datefilter"]').val("")
    $('#check_in_date').val("");
    $('#check_out_date').val("");

    stepClick(0,0)
    $("#collapseOne").collapse('show');
}

function registerBooking(event){
    event.preventDefault();

    var roomID = $('#availableRooms').val();
    var duration = $('#booking_duration').text().replace(/\D/g, "");
    var total = $('#booking_total').text().replace(/\D/g, "");
    var checkIn = $('#check_in_date').val();
    var checkOut = $('#check_out_date').val();
    var paymentOption = $('#paymentOptionSelector').val();
    var paymentStatus = $('#paymentStatusSelector').val();
    var employee = $('#employeeSelector').val();
    var customers = [];

    if(!employee){
        alert($.t("reservation.step3.select"))
        return;
    }

    if(customerList.children.length <= 0){
        alert($.t("reservation.step1.selector"));
        return;
    }

    if(!paymentStatus){
        alert($.t("error.err7"));
        return;
    }

    if(paymentStatus!=="Unpaid"){
        if(!paymentOption){
            alert($.t("error.err7"));
            return;
        }
    }

    for (const list of customerList.children) {
        customers.push(list.dataset.id);
    }

    $.ajax({
        url:`./controllers/registerBooking.php?register`,
        type:"POST",
        data:{
            roomID:roomID,
            checkOut:checkOut,
            checkIn:checkIn,
            duration:duration,
            total:total,
            paymentOption:paymentOption,
            paymentStatus:paymentStatus,
            customer:JSON.stringify(customers),
            employee:employee
        },
        success: function(data){
            
            if(data==='success'){
                resetBooking();
                appendAlert("Room reserved successfully", 'success')
            }
            else appendAlert(data, "danger");
        }   
    })
}

// Booking

function loadBooking(){
    
    var display_booking = document.getElementById('display_booking');
    display_booking.innerHTML='';

    var type = $("#bookingTypeSelector").val();
    var search = $("#bookingSearchBar").val();

    let query = `${type}*${search}`;
    
    function addElement(data, number){

        var status = data.status;
        var payment = data.paymentStatus;
        var bg, pay_lang, stat_lang;

        if(status==="Staying"){
            bg = "bg-primary-subtle";
            stat_lang="booking.status.stay";
        }
        else if (status==="Reserved"){
            bg = "bg-warning-subtle";
            stat_lang="booking.status.reserve";
        }
        else if (status==="Cancelled"){
            bg = "bg-danger-subtle";
            stat_lang="booking.status.cancel";
        }
        else{
            bg = "bg-success-subtle"; 
            stat_lang="booking.status.finish";
        }

        if(payment==="Paid"){
            pay_lang="payment.paid";
        }
        else if (payment==="Deposit"){
            pay_lang="payment.deposit";
        }
        else{
            pay_lang="payment.unpaid";
        }

        var display=`
            <tr class='${bg}'>
                <td class="align-middle en-font"> ${number} </td>
                <td class="align-middle en-font"> ${data.id} </td>
                <td class="align-middle en-font"><b> ${data.room} </b></td>
                <td class="align-middle en-font"><b> ${data.roomType} </b></td>
                <td class="align-middle fw-bold en-font"> ${data.checkIn} </td>
                <td class="align-middle fw-bold en-font"> ${data.checkOut} </td>
                <td class="align-middle">
                    <span class="en-font">${data.duration} </span>
                    <span data-i18n="booking.table.night"></span> 
                </td>
                <td class="align-middle en-font"> ${formatNumber(data.total)} KIP</td>
                <td class="align-middle" data-i18n=${pay_lang}> </td>
                <td class="align-middle bg-info-subtle fw-bold" data-i18n=${stat_lang}> </td>
                <td class="d-flex justify-content-around">
                    <button 
                        type="button" 
                        class="btn btn-success btn-sm" 
                        id="btnLogCollapse${data.id}"
                        aria-expanded="false" 
                        onclick="showBookingLog('${data.id}')"
                    >
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </button>
                    <button 
                        type="button" 
                        class="btn btn-primary btn-sm"
                        onclick="viewBookingInfo('${data.id}')" 
                        data-bs-toggle="modal" 
                        data-bs-target='#bookingRoomModal'
                        ${status==="Finished" || status==="Cancelled" ? 'disabled' : ''}
                    >
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <td colspan="11" class="p-0 ">
                <div class="collapse" id="bookingLog${data.id}">
                    <div class="card card-body row ${bg} border-0 px-0 py-2">
                    </div>
                </div>
            </td>
        `
        
        display_booking.innerHTML += display;
    }

    $.ajax({
        url:`./controllers/manageBooking.php?all&search=${query}`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            for(var i=0; i<data.length; i++){
                addElement(data[i], i+1);
            }

            $('#display_booking').localize();
        }

    })
}

function viewBookingInfo(id, form){
    var tableBody = document.getElementById('bookedCustomerTb');
    tableBody.innerHTML="";

    function getCustomer(id, handleData){
        return $.ajax({
            url:`./controllers/getCustomer.php?id=${id}`,
            type:"GET",
            dataType:"JSON",
            success: function(data){
               handleData(data);
            }   
        })
    }
    
    function fillInTable(booking){
        const customers = JSON.parse(booking.customers);
        customers.map((customer, i)=>{
            getCustomer(customer, function(data){
                var display = `
                    <tr>
                        <td>${data.cust_name + "  " + data.cust_firstname}</td>
                        <td>${data.cust_bd}</td>
                        <td>${data.contact}123421232321 12312</td>
                        <td>${data.email}</td>
                        <td>${data.passport}</td>
                    </tr>
                `;
    
                tableBody.innerHTML += display;
            });

        })
    }

    function fillBookingModal(booking){
        $('#bookingRoomModal').data('id', id);
        $('#booking_ID_Title').text(id);
        $('#bookingRoomModal').data('form', form);
        $('#bookingCID').val(booking.checkIn);
        $('#bookingCOD').val(booking.checkOut);
        $('#bookingStatus').val(booking.status);
        $('#bookedRoom').val(booking.room);
        $('#bookedRoom').data('id', booking.roomID);
        $('#bookingModalDuration').val(booking.duration + " days");
        $('#bookingModalTotal').val(formatNumber(booking.total) + " KIP");
        $('#bookingModalPayment').val(booking.paymentStatus);

        if(booking.paymentStatus==="Unpaid"){
            $('#bookingPaymentOption').prop('disabled', false);
            $("#bookingPaymentOption").val($("#bookingPaymentOption option:first").val());
        }
        else {
            $("#bookingPaymentOption").prop('disabled', 'disabled');
            $('#bookingPaymentOption').val(booking.paymentOption);
        }
        
        if(booking.payment === "false") $('#bookingModalPayment').addClass('text-danger');
        else $('#bookingModalPayment').removeClass('text-danger');
    } 

    $.ajax({
        url:`./controllers/manageBooking.php?single&id=${id}`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            fillInTable(data[0]);
            fillBookingModal(data[0]);
        }   
    })
}

function showBookingLog(id){

    var log_container = document.getElementById(`bookingLog${id}`).children[0];

    const displayLog=(data)=>{

        var room = data.room;

        if(data.movement==="Moved"){
            room=`
                ${data.old_room} &nbsp; <i class="fa fa-arrow-right"></i> &nbsp; ${data.room}
            `;
        }

        var display =`
            <main class="log col-12 en-font row py-2 ps-5 border-bottom border-secondary-subtle text-start">
                <span class="col-2 fw-bold text-capitalize text-secondary"> ${data.movement} </span>
                <span class="col-2"> ${data.time} </span>
                <span class="col-2 fw-semibold"> ${room}</span>
                <span class="col-6"> ${data.memo}</span>
            </main>
        `
        log_container.innerHTML+=display;
        
    }

    if(log_container.innerHTML.trim()==="") {
        $.ajax({
            url:`./controllers/getRoomLog.php?&one-booking-logs`,
            type:"POST",
            data:{
                id:id
            },
            dataType:"JSON",
            success: function(data){
                for(var i=0; i<data.length; i++){
                    displayLog(data[i]);
                }
            }   
        })
    }

    $(`#bookingLog${id}`).collapse('toggle');
}

// Room

function loadRooms(){
    
    var display_room = document.getElementById('display_room');
    display_room.innerHTML='';

    var type = $("#roomTypeSelector").val();
    var search = $("#roomSearchBar").val();

    var query = `${type}*${search}`;
    
    function addElement(data){

        var status = data.status;
        var type = data.type;
        var color, pic, type;

        var bookingBtn=`
            <button class="btn btn-sm btn-primary staff_icon" 
                onclick="getRoomBookingList('${data.id}')" 
                data-bs-toggle="offcanvas" 
                data-bs-target="#bookingOffCanvas"
                data-i18n="rooms.btn_booking"
            ></button>
        `

        if(type==="Single Room"){
            pic = "url('https://www.hotelmonterey.co.jp/upload_file/monhtyo/stay/sng_600_001.jpg');";
        }
        else if (type==="Double Room"){
            pic = "url('https://www.colatour.com.tw/COLA_AppFiles/A03H_Hotel/Images/209677-04.GIF');";
        }
        else if (type==="Deluxe Room"){
            pic = "url('https://mardhiyyahhotel.com/wp-content/uploads/sites/18/2021/03/CORPORATE-FLOOR-DELUXE-ROOM_KING-1.png');";
        }
        else {
            pic = "url('https://visotsky-hotel.ru/en/assets/photo/vip-rooms-photo/room-5101/hotel-visotsky-vip-rooms-5101-01.jpg');";
        }

        if(status==="Reserved"){
            color = "text-warning";
            type="rooms.status.reserve";
        }
        else if (status==="Occupied"){
            color = "text-primary";
            type="rooms.status.occupy";
        }
        else{
            color = "text-success"; 
            bookingBtn= '';
            type="rooms.status.free";
        }

        var display=`
            <main class="room_box p-3 rounded-10" id="room_box">
                <div class="room_title p-0" style="background-image:${pic}">
                    <div class="bg-dark bg-opacity-50 en-font text-light p-2" style="width:auto">${data.name}</div>
                </div>
                
                <article class="border">
                    <aside class="bg-white py-2 border-bottom"> 
                        <b>
                            <span class="en-font">${data.type}</span>
                            &nbsp; 
                            <span class="${color}" data-i18n=${type}></span>
                        </b>
                    </aside>
                    <div class="bg-white py-2 d-flex justify-content-around">
                        <button class="btn btn-sm btn-success roomModalView" 
                            onclick="viewRoomInfo('${data.id}')"
                            data-bs-toggle="modal" 
                            data-bs-target="#roomModal" 
                            data-i18n="rooms.btn_view"
                        ></button>
                        ${bookingBtn}
                    </div>
                </article>
            </main>
        `;
        
        display_room.innerHTML += display;
    }

    $.ajax({
        url:`./controllers/getRoom.php?search=${query}`,
        type:"GET",
        dataType:"JSON",
        success: function(res){
            for(var i=0; i<res.length; i++){
                addElement(res[i]);
            }
            $('body').localize();
        }

    })
}

function getRoomTypePrice(roomTypeId){
    var price = document.getElementById('roomModal_price');

    $.ajax({
        url:`./controllers/getRoomPrice.php?id=${roomTypeId}`,
        type:"GET",
        dataType:"JSON",
        success: function(res){
            let val = formatNumber(res['price']);
            price.value = val+" KIP / day";
        }   
    })
}

function clearRoomModal() {
    appendAlert("Room managed successfully", "success");
    document.getElementById('roomModalForm').reset();
    $("#roomModal").modal('hide');

    loadRooms();
}

function manageRoom(event){
    event.preventDefault();

    var roomID="", url;
    var roomName = $("#roomModal_name").val();
    var roomType = $("#roomModal_type").val();
    var manageType = $('#roomModal').data('submit');

    if(manageType==="new"){
        url = `./controllers/manageRoom.php?new`;
    }else{
        url = `./controllers/manageRoom.php?edit`;
        roomID = $('#roomModal').data('id');
    }

    if(roomType){
        $.ajax({
            url:url,
            type:"POST",
            data:{
                roomID:roomID,
                roomName:roomName,
                roomType:roomType
            },
            success: function(data){
                if(data==='success') clearRoomModal();
                else appendAlert(data.error, "danger");
            }   
        })
    }
}

function delRoom(){
    var status = $('#roomModal_status').val();
    var type = $("#roomModal").data('submit');
    var id = $("#roomModal").data('id');

    if(status ==="Booked") alert($.t("error.err1"));
    else if (type === "new") alert($.t("error.err2"));
    else{
        $.ajax({
            url:`./controllers/manageRoom.php?del=${id}`,
            type:"POST",
            success: function(data){
                if(data==='success') clearRoomModal();
                else appendAlert(data.error, "danger");
            }   
        })
    }

}

function addNewRoom(){
    document.getElementById('roomModalForm').reset();
    $('#roomModalTitle').text("Room Info -- New")
    $('#roomModal').data('submit', 'new');
    $('#btnRoomModalSubmit').attr("data-i18n", "modal.add");

    $('#roomModal').localize();
}

function getRoomBookingList(id){
    $.ajax({
        url:`./controllers/manageBooking.php?room&id=${id}`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            var offCanvas = document.getElementById('offCanvas-body');
            offCanvas.innerHTML= '';

            data.map((booking)=>{
                const payment = booking.paymentStatus;
                const status = booking.status;
                var payment_lang, status_lang

                if(payment==="Paid") payment_lang = "payment.paid";
                if(payment==="Unpaid") payment_lang = "payment.unpaid";
                if(payment==="Deposit") payment_lang = "payment.deposit";

                if(status==="Finished") status_lang = "booking.status.finish";
                if(status==="Reserved") status_lang = "booking.status.reserve";
                if(status==="Staying") status_lang = "booking.status.stay";

                var card = `
                    <div class="card w-100 border border-dark mb-4">
                        <div class="card-body">
                            <h5 class="card-title en-font"> <b>${booking.checkIn}  &nbsp; --- &nbsp; ${booking.checkOut}</b></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary fw-semibold">
                                <span data-i18n="sidebar.menu2"></span> 
                                <span  class="en-font"> ID:</span>
                                <span class="en-font">${booking.id}</span>
                            </h6>
                            <div class="card-text row">
                                <div class="col-6 text-start mt-2 px-0">
                                    <span data-i18n="booking.info.duration"></span>:
                                    <span class="fw-bold en-font">${booking.duration} </span>
                                    <span data-i18n="booking.table.night"></span>
                                </div>
                                <div class="col-6 text-start mt-2 px-0">
                                    <span data-i18n="booking.info.total"></span>:
                                    <span class="fw-bold en-font">${formatNumber(booking.total)}K </span>
                                </div>
                                <div class="col-6 text-start mt-2 px-0">
                                    <span data-i18n="booking.table.status"></span>:
                                    <span class="fw-bold" data-i18n="${status_lang}"></span>
                                </div>
                                <div class="col-6 text-start my-2 px-0">
                                    <span data-i18n="booking.table.payment"></span>:
                                    <span class="fw-bold" data-i18n="${payment_lang}"></span>
                                </div>
                            </div>
                            <button 
                                class="btn btn-primary btn-sm w-100" 
                                onclick="viewBookingInfo('${booking.id}', 'rooms')" 
                                data-bs-toggle="modal" 
                                data-bs-target='#bookingRoomModal'
                                data-i18n="rooms.btn_view"
                            > 
                            </button>
                        </div>
                    </div>
                `

                offCanvas.innerHTML += card;
            })

            $('body').localize();
        }   
    })
}

function viewRoomInfo(id){
    function showRoomInfo(data){
        var price = formatNumber(data.price);
        var day_suffix = $("#languageSwitcher").val() === "en" ? 'Night' : "ວັນ"
        var status_lang, status = data.status;

        if(status==="Reserved") status_lang = "rooms.status.reserve";
        if(status==="Occupied") status_lang = "rooms.status.occupy";
        if(status==="Free") status_lang = "rooms.status.free";

        $('#roomModal_name').val(data.name);
        $('#roomModal_type').val(data.typeID);
        $('#roomModal_price').val(price + " KIP / " + day_suffix);

        $('#roomModal_status').attr('value', $.t(status_lang));
        $('#roomModal').data('id', data.id);
        $('#roomModal').data('submit', 'edit');
        $('#roomModalTitle').text("Room Info -- Edit")
        $('#btnRoomModalSubmit').attr("data-i18n", "modal.edit");

        $('body').localize();
    }

    $.ajax({
        url:`./controllers/getRoom.php?id=${id}`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            showRoomInfo(data[0]);
        }   
    })
}

// room movement

function reloadAfterRoomAction(form){
    if(form==="calender"){
        clearCalender();
        createSchedule();
    }else if (form==="booking"){
        loadBooking();
    }else if (form==="rooms"){

        setTimeout(() => {
            loadRooms();
        }, 1000);
        
        $("#bookingRoomModal").modal('hide');
        $("#bookingOffCanvas").offcanvas('hide');
    }
}

function payBooking(status){
    const id = $('#bookingRoomModal').data('id');
    const form = $('#bookingRoomModal').data('form');
    const option = $('#bookingPaymentOption').val();

    if(option===null) return;

    $.ajax({
        url:`./controllers/updatePaymentStatus.php?id=${id}`,
        type:"POST",
        data:{
            status:status,
            option:option
        },
        success: function(data){
            if(data==='success'){
                $('#bookingModalPayment').val(status);
                $('#bookingPaymentOption').prop('disabled', true);
                reloadAfterRoomAction(form);
                appendAlert(`Payment status has been updated`, "success");
            }
            else appendAlert(data, "danger");
        }   
    })
}

function roomCheckIn(){
    const id = $('#bookingRoomModal').data('id');
    const form = $('#bookingRoomModal').data('form');
    const payOption = $('#bookingPaymentOption').val();
    const time =  moment(new Date()).format("YYYY-MM-DD");
    const roomID = $("#bookedRoom").data('id');

    if(payOption===null) {
        alert($.t("error.err3"));
        return;
    }

    $.ajax({
        url:`./controllers/manageRoomLog.php?checkIn&id=${id}`,
        type:"POST",
        data:{
            roomID:roomID,
            status:"Checked In",
            time:time,
        },
        success: function(data){
            if(data==='success'){
                $("#bookingRoomModal").modal('hide');
                reloadAfterRoomAction(form);
                appendAlert(`Room has been Checked In`, "success");
            }
            else appendAlert(data, "danger");
        }   
    })
}

function roomCheckOut(){
    const id = $('#bookingRoomModal').data('id');
    const form = $('#bookingRoomModal').data('form');
    const time = $('#bookingCOD').val();
    const currentTime = moment(new Date()).format("YYYY-MM-DD");
    const roomID = $("#bookedRoom").data('id');
    const paid = $('#bookingModalPayment').val();
    var url;
    
    if(paid!=="Paid"){
        alert($.t("error.err4"));
        return;
    }

     if(currentTime < time){
        const earlyCheckOut= confirm("If You Are Checking Out Early, You Won't Get Refund Of Remaining Days");

        if(earlyCheckOut){
            url = `./controllers/manageRoomLog.php?earlyCheckOut&id=${id}`
        }

    }else {
        url = `./controllers/manageRoomLog.php?checkOut&id=${id}`;
    }

    $.ajax({
        url:url,
        type:"POST",
        data:{
            roomID:roomID,
            status:"Checked Out",
            time:time,
            currentDay:currentTime,
        },
        success: function(data){
            if(data==='success'){
                $("#bookingRoomModal").modal('hide');
                reloadAfterRoomAction(form);
                appendAlert(`Room has been Checked Out`, "success");
            }
            else {
                appendAlert(data, "danger");
                console.log("error");
            }
        }   
    })
    
}

function convertStringCommaToNumber(string) {
    string = string.replace(/,/g, "");
    return parseInt(string);
}

function openExtendDateModal(){
    const oldDateOut = $('#bookingCOD').val();
    let duration = $('#bookingModalDuration').val();
    let totalPrice = $('#bookingModalTotal').val();

    duration = convertStringCommaToNumber(duration);
    totalPrice = convertStringCommaToNumber(totalPrice);
    let price = Math.floor(totalPrice/duration);

    document.getElementById("new_check_out_date").min = oldDateOut
    $('#new_check_out_date').val('');
    $('#old_check_out_date').val(oldDateOut)
    $("#extend_room_price").text(formatNumber(price) + " KIP");
}

function extendBookingDate(){
    const id = $('#bookingRoomModal').data('id');
    const form = $('#bookingRoomModal').data('form');
    let newDateOut = $('#new_check_out_date').val();
    let duration = $('#extend_duration').text();
    let totalPrice = $('#extend_total').text();

    duration = convertStringCommaToNumber(duration);
    totalPrice = convertStringCommaToNumber(totalPrice);

    if(newDateOut===''){
        alert($.t("error.err5"));
        return;
    }

    $.ajax({
        url:`./controllers/registerBooking.php?extend&id=${id}`,
        type:"POST",
        data:{
            newDate:newDateOut,
            duration:duration,
            total:totalPrice
        },
        success: function(data){
            if(data==='success'){
                $("#extendBookingModal").modal('hide');
                reloadAfterRoomAction(form);
                appendAlert(`Booking Extended For ${duration} Days Until ${newDateOut}`, "success");
            }
            else appendAlert(data, "danger");
        }   
    })
}

function moveRoom(){
    const bookingID = $('#bookingRoomModal').data('id');
    const form = $('#bookingRoomModal').data('form');
    const time = moment(new Date()).format("YYYY-MM-DD");
    const CID = $("#bookingCID").val();
    const bookingStatus = $("#bookingStatus").val();
    const memo = $('#movingRoomMemo').val();
    const roomID = $('#availableRooms').val();
    const prevRoomID = $("#bookedRoom").data('id');
    var action;

    if(roomID===null){
        alert($.t("error.err6"));
        return;
    }

    if(bookingStatus==="Reserved" || time <= CID){
        action = "re-book" 
    }else{
        action = "move"
    }

    $.ajax({
        url:`./controllers/manageRoomLog.php?${action}&id=${bookingID}`,
        type:"POST",
        data:{
            roomID:roomID,
            status:'Moved',
            time:time,
            prevRoom:prevRoomID,
            memo:memo
        },
        success: function(data){
            if(data==='success'){
                $("#moveRoomModal").modal('hide');
                reloadAfterRoomAction(form);
                appendAlert(`Room has been ${action}.`, "success");
            }
            else appendAlert(data, "danger");
        }   
    })    
}

function cancelBooking(){
    const BookingID = $('#bookingRoomModal').data('id');
    const form = $('#bookingRoomModal').data('form');
    const time = moment(new Date()).format("YYYY-MM-DD");
    const memo = $('#cancelMemo').val();
    const roomID = $("#bookedRoom").data('id');
    const payStatus = $("#bookingModalPayment").val();

    if(payStatus!=="Unpaid"){
       if( confirm("If you cancel the room, you won't get the money back") === false) return;
    }

    $.ajax({
        url:`./controllers/manageRoomLog.php?cancel&id=${BookingID}`,
        type:"POST",
        data:{
            roomID:roomID,
            status:"Cancelled",
            time:time,
            memo:memo
        },
        success: function(data){
            if(data==='success'){
                appendAlert(`Booking Cancelled.`, "success");
                reloadAfterRoomAction(form);
                $("#cancelModal").modal('hide');
            }
            else appendAlert(data, "danger");
        }   
    })    
   
}

function backToBookingModal(){
    $("#movingRoomType")[0].selectedIndex = 0;
    $("#availableRooms")[0].selectedIndex = 0;
    $("#movingRoomMemo").val("");
    $("#cancelMemo").val("");
    $("#remaining_days").text("0 Night");
    $("#origin_price").text("0 KIP");
    $("#movingExtraFee").text("0 KIP");
}

function getFreeRoomForMoving(id){
    var roomSelector = document.getElementById('availableRooms');

    const movingDate = formatDate(today);  
    const dateOut = $("#bookingCOD").val(); 

    let duration = $('#bookingModalDuration').val();
    let totalPrice = $('#bookingModalTotal').val();

    duration = convertStringCommaToNumber(duration);
    totalPrice = convertStringCommaToNumber(totalPrice);
    const originalprice = Math.floor(totalPrice/duration);

    $.ajax({
        url:`./controllers/getRoom.php?free`,
        type:"POST",
        data:{
            type:id,
            checkIn:movingDate,
            checkOut:dateOut,
        },
        dataType:"JSON",
        success: function(data){
            if(data.length > 0){
                roomSelector.innerHTML="<option selected disabled> Please select the room no. </option>";               
                for(var i =0; i<data.length; i++){
                    var display =`
                        <option value='${data[i].id}'>${data[i].name}</option>
                    `;
                    roomSelector.innerHTML+=display;
                }

                const remainingDay = getDaysBetween(movingDate, dateOut);
                const newPrice = data[0].price;

                $("#remaining_days").text(remainingDay);
                $("#origin_price").text(formatNumber(newPrice) + " KIP");
                $("#movingExtraFee").text(formatNumber((newPrice - originalprice)*remainingDay) + " KIP");

            }else{
                $("#movingRoomType")[0].selectedIndex = 0;
                appendAlert("No Room Availabe. Please Choose Different Room Type !!!", "danger")
            }
        }   
    })
}

function calculateDuration_Total(d1, d2, price, duration, total){

    var totalDays = document.getElementById(duration);
    var unitPrice = document.getElementById(price).innerText.replace(/\D/g, "");
    var totalPrice = document.getElementById(total);

    if(d1.value !==""){
        d2.min = d1.value;
        d2.focus();
    }

    if(d1.value !=="" && d2.value !==""){
        let totalStay = getDaysBetween(d1.value, d2.value);
        totalDays.innerHTML=totalStay;
        totalPrice.innerHTML = formatNumber(totalStay * parseInt(unitPrice)) + " KIP";
    }
}

function getDaysBetween(d1, d2){
    let dt1 = new Date(d1).getTime();
    let dt2 = new Date(d2).getTime();

    let diff = dt2 - dt1;
    let dayDiff = Math.ceil(diff / (1000 * 3600 * 24));

    return (dayDiff);
}

// setting
function openRoomTypeModal(type, id, name, price){
    $("#roomTypeModal").data('type', type);
    $('#roomType__id').val(id);
    $('#roomType__name').val(name);
    $('#roomType__price').val(price);
    $('#roomTypeButton').attr("data-i18n", "modal."+type);

    $("#accordionSetting").localize();
}

function refreshRoomType(){

    var roomTypeBody = document.getElementById('roomType_tbody');
    roomTypeBody.innerHTML = '';

    function showRoomType(data){

        var display=`
        <tr class="text-center">  
            <td>
                <span class="fw-bold fs-6" style="color:#6c757d"> 
                    ${data.id}
                </span>                                
            </td>

            <td>
                <span class="fw-bold fs-6" style="color:#6c757d">
                    ${data.name}
                </span>                                
            </td>
            
            <td>
                <span class="badge text-bg-success fs-6" >                                
                    ${ formatNumber(data.price)} KIP
                </span>                                                                  
            </td>     

            <td>
                <button class="btn btn-primary" 
                    data-bs-toggle="modal" 
                    data-bs-target="#roomTypeModal" 
                    onclick="openRoomTypeModal('edit', ${data.id}', '${data.name}', '${data.price}')" 
                >
                    <i class="fa fa-pencil"></i>
                </button>
                <button class="btn btn-danger" onclick="delRoomType('${data.id}')">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        `

        roomTypeBody.innerHTML += display;
    }

    $.ajax({
        url:`./controllers/getRoomType.php`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            for(var i=0; i<data.length; i++){
                showRoomType(data[i]);
            }
        }   
    })
}

function roomTypeManage(){
    const type = $("#roomTypeModal").data('type');
    const id = $("#roomType__id").val();
    const name = $("#roomType__name").val();
    const price = $("#roomType__price").val();

    $.ajax({
        url:`./controllers/manageRoomType.php?${type}`,
        type:"POST",
        data:{
            id:id,
            name:name,
            price:parseInt(price)
        },
        success: function(data){
            if(data==='success'){
                refreshRoomType();
                $("#roomTypeModal").modal('hide');
                appendAlert(`Room type ${type}ed Successfully`, "success");
            }else appendAlert(data.error, "danger");
        }   
    })
}

function delRoomType(id){
    $.ajax({
        url:`./controllers/manageRoomType.php?del`,
        type:"POST",
        data:{
            id:id,
        },
        success: function(data){
            if(data==='success'){
                refreshRoomType();
                appendAlert(`Room type deleted Successfully`, "success");
            }else appendAlert(data.error, "danger");
        }   
    })
}

function openStaffModal(type, id, name, gender, ID_Card, phone, email, position, salary){
    $("#staffModal").data('type', type);
    $("#staffModal").data('id', id);
    $('#staff__name').val(name);
    $('#genderSelect').val(gender);
    $('#staff__id_card').val(ID_Card);
    $('#staff__phone').val(phone);
    $('#staff__email').val(email);
    $('#staff__position').val(position);
    $('#staff__salary').val(salary);
    $('#staffBtn').attr("data-i18n", "modal."+type);

    $("#accordionSetting").localize();
}

function refreshStaff(){

    var staff_tbody = document.getElementById('staff_tbody');
    staff_tbody.innerHTML = '';

    function showStaff(data){

        var display=`
        <tr class="text-center">                            
            <td>
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-start flex-column">
                        <div class="fw-bold fs-6">
                            ${data.name}
                        </div>
                        <span class="fw-semibold d-block text-body-tertiary text-start">
                            (${data.ID_Card})
                        </span>
                    </div>
                </div>                                
            </td>

            <td>
                <span class="fw-bold fs-6" style="color:#6c757d">
                    ${data.phone}
                </span>                                
            </td>

            <td>
                <span class="fw-bold fs-6" style="color:#6c757d">
                    ${data.email}
                </span>                                
            </td>

            <td>
                <span class="fw-bold fs-6" style="color:#6c757d">
                    ${data.position}
                </span>                                
            </td>
            
            <td>
                <span class="badge text-bg-success fs-6">                                
                    ${formatNumber(data.salary)} KIP
                </span>                                                                  
            </td>     

            <td>
                <button class="btn btn-primary" 
                    data-bs-toggle="modal" 
                    data-bs-target="#staffModal" 
                    onclick="openStaffModal('edit', '${data.id}', '${data.name}', '${data.gender}', '${data.ID_Card}', '${data.phone}', '${data.email}', '${data.position}', '${data.salary}')" 
                >
                    <i class="fa fa-pencil"></i>
                </button>
                <button class="btn btn-danger" onclick="delStaff('${data.id}')">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
        `

        staff_tbody.innerHTML += display;
    }

    $.ajax({
        url:`./controllers/getStaff.php`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            for(var i=0; i<data.length; i++){
                showStaff(data[i]);
            }
        }   
    })
}

function staffManage(){
    const type = $("#staffModal").data('type');
    const id = $("#staffModal").data('id');
    const name = $("#staff__name").val();
    const gender = $("#genderSelect").val();
    const ID_Card = $("#staff__id_card").val();
    const phone = $('#staff__phone').val();
    const email = $('#staff__email').val();
    const position = $('#staff__position').val();
    const salary = $('#staff__salary').val();

    $.ajax({
        url:`./controllers/manageStaff.php?${type}`,
        type:"POST",
        data:{
            id:id,
            name:name,
            gender:gender,
            ID_Card:ID_Card,
            phone:phone,
            email:email,
            position:position,
            salary:parseInt(salary)
        },
        success: function(data){
            if(data==='success'){
                refreshStaff();
                $("#staffModal").modal('hide');
                appendAlert(`Staff ${type}ed Successfully`, "success");
            }else appendAlert(data, "danger");
        }   
    })
}

function delStaff(id){
    $.ajax({
        url:`./controllers/manageStaff.php?del`,
        type:"POST",
        data:{
            id:id,
        },
        success: function(data){
            if(data==='success'){
                refreshStaff();
                appendAlert(`Staff deleted Successfully`, "success");
            }else appendAlert(data.error, "danger");
        }   
    })
}

// window onLoad

window.onload = function() {
    if(schedulePage){
        createSchedule();
    }
};

$(document).ready(function() {

    setTimeout(function() {
        $("mainAlert").alert('close');
    }, 2000);
});
