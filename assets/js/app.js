let loginStopWatch;

var today = new Date();
var year = today.getFullYear();
var month = today.getMonth() + 1;

var schedule_month = document.getElementById("schedule-month");
var cal_header = document.getElementById('calender_header');
var cal_body = document.getElementById("calender_body");
var schedulePage = document.getElementById('schedule');

var custInfoAddTitle = "Add New Customer";
var custInfoEditTitle = "Edit Customer";
const custList = document.querySelector('.booking-customer-list');
const custSelector = document.getElementById("custSelector");

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
        row_head.innerHTML=name;
        table_tr.appendChild(row_head);
        
        for (let i = 1; i <= totalDays; i++){
            const date = document.createElement(element);

            if(isTbody){
                date.style.position = "relative";
                date.classList.add("bg-opacity-75");
                date.classList.add("bg-success");
                date.setAttribute("id", id + "-" + i);
                
                date.setAttribute("data-toggle", "tooltip");
                date.setAttribute("data-placement", "top");
                date.setAttribute("title", `
                    It is ${i} datedafdfadfadf  asdf asdf
                    adfafda
                    adfadfadf
                `);
            }else{
                date.innerHTML = twoDigitNumber(i)
                date.setAttribute("scope", "col");
                
                if(today.getFullYear()=== year && today.getMonth()===month-1 && today.getDate()===i){
                    date.classList.add("bg-warning");
                }else console.log("no");
            }
            table_tr.appendChild(date);
        }

        parent.appendChild(table_tr);
    }

   insertDates(cal_header, "th", "#");

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
            let roomNames = data.map(a => ({id: a.id, name:a.name}));
            createCalender(roomNames);
            getBookingSchedule();
        }   
    })
}

function getBookingSchedule(){
    $.ajax({
        url:`./controllers/getBookingLog.php?all`,
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

function insertDataToSchedule(data){
    const groupedData = data.reduce((acc, cur) => {
        if (acc.find(item => item.bookingID === cur.b_id)) {
            const existingItem = acc[acc.findIndex(item => item.bookingID === cur.b_id)].action;
            existingItem.push({
                roomID:cur.roomID,
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
                action:[{
                    roomID:cur.roomID,
                    movement: cur.movement,
                    movement_time: cur.movement_time,
                    memo:cur.memo,
                }]
            });
        }
        
        return acc;
    }, []);

    groupedData.map((booking, i)=>{
        var dateOut, dateIn;
        const dateInMonth = +booking.dateIn.split('-')[1];
        const dateOutMonth = +booking.dateOut.split('-')[1];
        const actions = booking.action

        dateIn = dateInMonth < month ? 1 : +booking.dateIn.split('-')[2];
        dateOut = dateOutMonth === month ? +booking.dateOut.split('-')[2] : getTotalDays(year, month);

        const originalReservation = actions.find(o=> o.movement ==="Reserved");
        
        putLabelInCalender(dateIn, dateOut, actions, originalReservation.roomID, i+1)
    })
}

function styleCalenderBooking(id, remove, add){
    const bk_date = document.getElementById(id);
    bk_date.classList.remove(`bg-${remove}`);
    bk_date.classList.add(`bg-${add}`);
}

function createNumberBooking(id, bookingNo){
    document.getElementById(id).innerHTML+=`
        <div class="position-absolute top-0 start-0 px-1 text-white"  style="font-size: 12px;"> ${bookingNo} </div>
    `;
}

function removeNumberBooking(id){
    var bk_date = document.getElementById(`${id}`);
    bk_date.children[0].remove();
}

function putLabelInCalender(dateIn, dateOut, actions, originalRoom, bookingNo){

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
                styleCalenderBooking(id, "success", "primary");
                createNumberBooking(id, bookingNo);
            }

            return;
        }

        if(timeMonth != month) return;

        if(movement==="Moved"){
            for(var i = timeDate; i<=dateOut; i++){
                const id = originalRoom + '-' + i;
                styleCalenderBooking(id, "primary", "success");
                removeNumberBooking(id);
            }   

            ball.classList.add("bg-warning");
        }

        if(movement==="Checked In") ball.classList.add("bg-white");
        if(movement==="Checked Out") ball.classList.add("bg-dark");
        
        styleCalenderBooking(roomID + '-' +timeDate, "success", "primary");
        createNumberBooking(roomID + '-' +timeDate, bookingNo);

        document.getElementById(roomID + '-' + timeDate).appendChild(ball);
    })
}


// booking

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

function getDuration(d1, d2, price, duration, total){

    var totalDays = document.getElementById(duration);
    var unitPrice = document.getElementById(price).innerText.replace(/\D/g, "");
    var totalPrice = document.getElementById(total);

    if(d1.value !==""){
        d2.min = getNextDay(d1)
        d2.focus();
    }

    if(d1.value !=="" && d2.value !==""){
        let totalStay = getDaysBetween(d1.value, d2.value);
        totalDays.innerHTML= totalStay===1? `${totalStay} Day` : `${totalStay} Days`;
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

function fetchFreeRoom(id){
    var roomSelector = document.getElementById('availableRooms');
    var duration = $('#booking_duration').text().replace(/[^0-9]/g, "");;

    $.ajax({
        url:`./controllers/getRoom.php?typeID=${id}`,
        type:"GET",
        dataType:"JSON",
        success: function(res){
            roomSelector.innerHTML="<option selected disabled> Select The Room Number</option>";

            let price = formatNumber(res[0].price);
            let totalPrice = formatNumber(parseInt(duration) * res[0].price)

            $('#booking_room_price').text(price + " KIP");
            $('#booking_total').text(totalPrice + " KIP");
            
            for(var i =0; i<res.length; i++){
                var display =`
                    <option value='${res[i].id}'>${res[i].name}</option>
                `;
                roomSelector.innerHTML+=display;
            }
        }   
    })
}

function checkDulpicateCustList(id){
    
    let result = false;

    for (const child of custList.children) {
        if(child.id === id) result = true;
    }

    return result

}

function custSelect(value){
    custSelector.value ="0";

    const id = value.split("/")[0];
    const name = value.split("/")[1];    

    if(!checkDulpicateCustList(`cl-${id}`)){

        var custBtn = `
            <button type="button" id='cl-${id}' data-id='${id}'>
                <span onclick="custListClick('${id}')" data-bs-toggle="modal" data-bs-target="#customerModal">${name}</span>
                <em class="fa fa-close text-danger ms-1" onclick="removeCustList('cl-${id}')"></em>
            </button>
        `
        custList.innerHTML+=custBtn;  
    };

}

function removeCustList(id){
    document.getElementById(id).remove();
}

function addNewCustomer(){
    $('#btnCustInfoSubmit').text(custInfoAddTitle);
    $('#customerModalTitle').text(custInfoAddTitle);
}

function updateCustList(id, name){
    const btnID = "cl-" + id;
    document.getElementById(btnID).innerHTML=`
        <span onclick="custListClick('${id}')" data-bs-toggle="modal" data-bs-target="#customerModal">${name}</span>
        <em class="fa fa-close text-danger ms-1" onclick="removeCustList('${btnID}')"></em>
    `;
}

function updateCustSelect(){
    $.ajax({
        url:`./controllers/getCustomer.php?all`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            custSelector.innerHTML=`<option value="0" selected disabled> Select the Customers</option>`;
            for(var i=0; i<data.length; i++){
                let fullName = data[i].cust_name + " " + data[i].cust_firstname;
                let value = data[i].cust_id + '/' + fullName;
                var option = `<option value='${value}'>${fullName}</option>`

                custSelector.innerHTML += option;
            }
        }   
    })
}

function custListClick(id){
    $('#btnCustInfoSubmit').text(custInfoEditTitle);
    $('#customerModalTitle').text(custInfoEditTitle);

    function showEditCustInfo(data){
        $('#cust_contact').val(data.contact);
        $('#cust_name').val(data.cust_name);
        $('#cust_fname').val(data.cust_firstname);
        $('#cust_email').val(data.email);
        $('#cust_id_passport').val(data.passport);
        $('#cust_bd').val(data.cust_bd);
        $('#customerModal').data('id', data.cust_id);
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

function customerSubmit(event){
    event.preventDefault();

    var cust_id = $('#customerModal').data('id');
    var cust_contact = $('#cust_contact').val();
    var cust_name = $('#cust_name').val();
    var cust_fname = $('#cust_fname').val();
    var email = $('#cust_email').val();
    var passport = $('#cust_id_passport').val();
    var bd = $('#cust_bd').val();

    var url=$('#btnCustInfoSubmit').text() === custInfoAddTitle ? "./controllers/addCustomer.php" : `./controllers/editCustomer.php`;

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
            closeCustModal();
            if(data==='success'){
                updateCustSelect();
                appendAlert("Customer managed successfully", "success");
                updateCustList(cust_id, cust_name + " " + cust_fname);
            }
            else appendAlert(data, "danger");
        }
    });
}

function closeCustModal(){
    document.getElementById("customerForm").reset();
    var closeBtn= document.getElementById("custModalClose");
    closeBtn.click();
}

function resetBooking(){
    custList.innerHTML='';
    $('#booking_duration').text('');
    $('#booking_room_price').text('');
    $('#booking_total').text('');
}

function registerBooking(event){
    event.preventDefault();

    var roomID = $('#availableRooms').val();
    var duration = $('#booking_duration').text().replace(/\D/g, "");
    var total = $('#booking_total').text().replace(/\D/g, "");
    var checkIn = $('#check_in_reserve').val();
    var checkOut = $('#check_out_reserve').val();
    var cbPayment = document.getElementById('cbPayment').checked;
    var customerList = [];

    for (const list of custList.children) {
        customerList.push(list.dataset.id);
    }
      

    function checkInputForm(){
        if(custList.children.length <= 0 || roomID === null || total === "0"){
            alert("Please Add Customers Or Select Room");
            return false;
        }else return true;
    }

    if(checkInputForm()){
        $.ajax({
            url:`./controllers/registerBooking.php`,
            type:"POST",
            data:{
                roomID:roomID,
                checkOut:checkOut,
                checkIn:checkIn,
                duration:duration,
                total:total,
                cbPayment:cbPayment,
                customer:JSON.stringify(customerList)
            },
            success: function(data){
                var resetBookingBtn = document.getElementById('resetBookingBtn')
                resetBookingBtn.click();
                
                if(data==='success'){
                    appendAlert("Customer managed successfully", "success");
                    updateCustList(cust_id, cust_name + " " + cust_fname);
                    updateCustSelect();
                }
                else appendAlert(data, "danger");
            }   
        })
    }

}


// rooms

function showRooms(str){
    var search_query = document.getElementById('roomSearchBar').value;
    let searchQ = `${str}*${search_query}`;
    loadRooms(searchQ);
}

function searchRoom(search){
    let room_type = document.getElementById('roomTypeSelector').value;
    let searchQ = `${room_type}*${search.value}`;
    loadRooms(searchQ);
}

function loadRooms(query){
    
    var display_room = document.getElementById('display_room');
    
    function addElement(data){
        let status = data.status;
        let bg ='', statCheck;
        if(status=='Free'){
            bg="bg-success";
            statCheck = true;
        }
        else {
            bg="bg-danger";
            statCheck = false;
        }

        var clientBtn = ``

        if(data.status==="Booked") clientBtn = `
            <em class="btn btn-primary staff_icon" data-bs-toggle="modal" data-bs-target='#bookingRoomModal'>Client</em>
        `

        var display=`
            <main class="room_box p-3 rounded-10">
                <div class="room_title p-0 ${bg}" style="--bs-bg-opacity: .5;">
                    ${data.name}
                </div>
                <article class="border">
                    <aside class="bg-white py-2 border-bottom"> 
                        <b>
                            ${data.type}
                            &nbsp; 
                            (${data.status})
                        </b>
                    </aside>
                    <div class="bg-white py-2 d-flex justify-content-around">
                        <em class="btn btn-success" onclick="viewRoomInfo('${data.id}')" data-bs-toggle="modal" data-bs-target="#roomModal" >
                            View
                        </em>
                        ${clientBtn}
                    </div>
                </article>
            </main>
        `
       display_room.innerHTML+=display;
    }

    $.ajax({
        url:`./controllers/getRoom.php?search=${query}`,
        type:"GET",
        dataType:"JSON",
        success: function(res){
            display_room.innerHTML="";

            for(var i=0; i<res.length; i++){
                addElement(res[i]);
            }
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

    var type = $("#roomTypeSelector").val();
    var search = $("#roomSearchBar").val();

    loadRooms(`${type}*${search}`);
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

function delRoom(){
    var status = $('#roomModal_status').val();
    var type = $("#roomModal").data('submit');
    var id = $("#roomModal").data('id');

    if(status ==="Booked") alert("You can't delete the room as it is already booked");
    else if (type === "new") alert("You can't delete the creating room");
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
    $('#btnRoomModalSubmit').text("ADD");
}

function viewRoomInfo(id){
    function showRoomInfo(data){
        let price = formatNumber(data.price);

        $('#roomModal_name').val(data.name);
        $('#roomModal_type').val(data.typeID);
        $('#roomModal_price').val(price + " KIP / day");
        $('#roomModal_status').val(data.status);
        $('#roomModal').data('id', data.id);
        $('#roomModal').data('submit', 'edit');
        $('#roomModalTitle').text("Room Info -- Edit")
        $('#btnRoomModalSubmit').text("EDIT");
    }

    $.ajax({
        url:`./controllers/getRoom.php?id=${id}`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            showRoomInfo(data[0])
        }   
    })
}

function viewBookingInfo(id){
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
                        <th scope="row">${i+1}</th>
                        <td>${data.cust_name + "  " + data.cust_firstname}}</td>
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
        $('#bookingCID').val(booking.checkIn);
        $('#bookingCOD').val(booking.checkOut);
        $('#bookedRoom').val(booking.room);
        $('#bookedRoom').data('id', booking.roomID);
        $('#bookingModalDuration').val(booking.duration + " days");
        $('#bookingModalTotal').val(formatNumber(booking.total) + " KIP");
        $('#bookingModalPayment').val(booking.payment);
        if(booking.payment === "false") $('#bookingModalPayment').addClass('text-danger');
        else $('#bookingModalPayment').removeClass('text-danger');
    } 

    $.ajax({
        url:`./controllers/getBooking.php?id=${id}`,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            fillInTable(data[0]);
            fillBookingModal(data[0]);
        }   
    })
}


// room movement
function payBooking(){
    const id = $('#bookingRoomModal').data('id');

    $.ajax({
        url:`./controllers/updatePaymentStatus.php?id=${id}`,
        type:"POST",
        success: function(data){
            if(data==='success'){
                $("#bookingRoomModal").modal('hide');
                appendAlert(`Payment status has been updated`, "success");
            }
            else appendAlert(data, "danger");
        }   
    })
}

function roomCheckIn_Out(status){
    const id = $('#bookingRoomModal').data('id');
    const time = new Date().toISOString().split('T')[0];
    const roomID = $("#bookedRoom").data('id');
    let url;

    if(status ==="Checked In") url=`./controllers/editBookingLog.php?checkIn&id=${id}`;
    else url =`./controllers/editBookingLog.php?checkOut&id=${id}`,

    $.ajax({
        url:url,
        type:"POST",
        data:{
            roomID:roomID,
            status:status,
            time:time,
        },
        success: function(data){
            if(data==='success'){
                $("#bookingRoomModal").modal('hide');
                if(status ==="Checked Out") loadRooms();
                appendAlert(`Room ${status} saved.`, "success");
            }
            else appendAlert(data, "danger");
        }   
    })
}

function bookedRoomMove_Cancel(){
    const id = $('#bookingRoomModal').data('id');
    const status = $('#memoModal').data('type');
    const time = new Date().toISOString().split('T')[0];
    const memo = $('#bookingMemo').val();
    let roomID, prevRoom = null, url;

    if($('#memoRoomSelect').is(":visible")) {
        roomID = $('#memoRoomSelect').val();
        prevRoom = $("#bookedRoom").data('id');
        url = `./controllers/editBookingLog.php?move&id=${id}`;
    }
    else{
        roomID = $("#bookedRoom").data('id');
        url = `./controllers/editBookingLog.php?cancel&id=${id}`;
    }

    if(roomID===null) alert("Please Choose Moved Room");
    else{
        $.ajax({
            url:url,
            type:"POST",
            data:{
                roomID:roomID,
                status:status,
                time:time,
                prevRoom:prevRoom,
                memo:memo
            },
            success: function(data){
                if(data==='success'){
                    $("#memoModal").modal('hide');
                    appendAlert(`Room ${status} saved.`, "success");
                }
                else appendAlert(data, "danger");
            }   
        })
    }

}

function openMoveModal(){
    $('#memoRoomSelect').show();
    $('#memoModal').data('type', 'Moved');
    const roomID = $("#bookedRoom").data('id');

    $('#memoRoomSelect option').each(function(){
        if($(this).val()===roomID){
            $(this).attr('disabled','disabled');
        }
    });
}

function openCancelModal(){
    $('#memoRoomSelect').hide();
    $('#memoModal').data('type', 'Cancelled');
}

// window onLoad

window.onload = function() {
    if(schedulePage){
        createSchedule();
    }
};


