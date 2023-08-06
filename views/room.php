<h1 class="pt-2 pb-3 room_page_nav" data-i18n="rooms.title"></h1>

<div class="d-flex justify-content-between align-items-center room_search_bar p-2 border-bottom border-dark">
    <select name="floor" id="roomTypeSelector" class="floorSelector" onchange="loadRooms()">
        <option value="all" data-i18n="selector.all" selected></option>
        <?php
            $sql ="SELECT * FROM `room_type`";
            $result = mysqli_query($conn, $sql);
            while($roomType = mysqli_fetch_array($result)){?>
                <option 
                    value=<?php echo $roomType['room_type_id']?> 
                    class="en-font"
                >
                    <?php echo $roomType['room_type_name']?>
                </option>
        <?php }?>
    </select>
    <div class="input-group" style="width: 300px !important;">
        <input type="text" id="roomSearchBar" class="form-control en-font" style="border:1px solid lightblue" placeholder="Search..." value="" onkeyup="loadRooms()"/>
    </div>

    <?php
        if($admin){
        echo'
            <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#roomModal" onclick="addNewRoom()">
                <i class="fa fa-plus me-2"></i>
                <span data-i18n="rooms.btn_add"></span>
            </button>
        ';
        }
    ?>
   
</div> 

<div class="display_room row my-4" id="display_room">
    <?php
        $room_query = "SELECT * FROM `room` NATURAL JOIN `room_type` ORDER BY room_name";
        $room_result = mysqli_query($conn, $room_query);
        while ($rooms = mysqli_fetch_assoc($room_result)) {

            if($rooms['room_type_name']==="Single Room"){
                $pic = "url('https://www.hotelmonterey.co.jp/upload_file/monhtyo/stay/sng_600_001.jpg');";
            }
            else if ($rooms['room_type_name']==="Double Room"){
                $pic = "url('https://www.colatour.com.tw/COLA_AppFiles/A03H_Hotel/Images/209677-04.GIF');";
            }
            else if ($rooms['room_type_name']==="Deluxe Room"){
                $pic = "url('https://mardhiyyahhotel.com/wp-content/uploads/sites/18/2021/03/CORPORATE-FLOOR-DELUXE-ROOM_KING-1.png');";
            }
            else {
                $pic = "url('https://visotsky-hotel.ru/en/assets/photo/vip-rooms-photo/room-5101/hotel-visotsky-vip-rooms-5101-01.jpg');";
            }
            
            if($rooms['room_status']==="Free"){
                $color = "text-success";
                $stat = "rooms.status.free";
            }
            else if ($rooms['room_status']==="Reserved"){
                $color = "text-warning";
                $stat = "rooms.status.reserve";
            }
            else{
                $color = "text-primary"; 
                $stat = "rooms.status.occupy";
            }
    ?>
        <main class="room_box p-3 rounded-10" id="room_box">
            <div class="room_title p-0 bg-opacity-50" style="background-image:<?php echo $pic?>">
                <div class="bg-dark bg-opacity-50 text-light p-2 en-font" style="width:auto"><?php echo $rooms['room_name'] ?></div>
            </div>
            <article class="border">
                <aside class="bg-white py-2 border-bottom"> 
                    <b>
                        <span class="en-font"><?php echo $rooms['room_type_name'] ?></span>
                        &nbsp; 
                        <span class="<?php echo $color?>" data-i18n=<?php echo $stat?>></span>
                    </b>
                </aside>
                <div class="bg-white py-2 d-flex justify-content-around">
                    <button class="btn btn-sm btn-success roomModalView" 
                        onclick="viewRoomInfo('<?php echo $rooms['room_id']?>')"
                        data-bs-toggle="modal" 
                        data-bs-target="#roomModal" 
                        data-i18n="rooms.btn_view"
                    ></button>
                    <?php
                    if($rooms['room_status']!=="Free"){?>
                        <button class="btn btn-primary staff_icon btn-sm" 
                            onclick="getRoomBookingList('<?php echo $rooms['room_id']?>')" 
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#bookingOffCanvas"
                            data-i18n="rooms.btn_booking"
                        ></button>
                    <?php }?>
                </div>
            </article>
        </main>
    <?php  }
    ?>
</div>


<div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="roomModalTitle" data-i18n="rooms.info.title">
                </h1>
                <button type="button" id="roomModalClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" onsubmit="manageRoom(event)" id="roomModalForm">
                <main class="modal-body row" style="height:100%; row-gap:20px" >
                    <div class="col-6">
                        <label class="my-2 float-start" data-i18n="rooms.info.name"></label>
                        <input 
                            type="text" 
                            id="roomModal_name" 
                            class="text-center form-control en-font" 
                            placeholder="Room Name" 
                            data-error="please fill in the room title" 
                            required
                        />
                    </div>
                    <div class="col-6">
                        <label class="my-2 float-start" data-i18n="rooms.info.type"></label>
                        <select 
                            id="roomModal_type" 
                            class="form-control"
                            onchange="getRoomTypePrice(this.value)"
                            data-error="please choose the room type"
                            required
                        >
                            <option selected disabled value='' data-i18n="rooms.info.select"></option>
                            <?php
                                $sql ="SELECT * FROM `room_type`";
                                $result = mysqli_query($conn, $sql);
                                while($roomType = mysqli_fetch_array($result)){?>
                                    <option 
                                        class="en-font"
                                        value=<?php echo $roomType['room_type_id']?> 
                                    >
                                        <?php echo $roomType['room_type_name']?>
                                    </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="my-2 float-start" data-i18n="rooms.info.price"></label>
                        <input type="text" class="text-center form-control en-font" id="roomModal_price" disabled/>
                    </div>
                    <div class="col-6">
                        <label class="my-2 float-start" data-i18n="rooms.info.status"></label> &nbsp;
                        <input type="text" class="form-control text-center text-success" id="roomModal_status" disabled/>
                    </div>
                </main>
                <div class="modal-footer">
                    <?php
                        echo '
                            <button type="submit" id="btnRoomModalSubmit" class="btn btn-primary"></button>
                            <button type="reset" class="btn btn-warning" data-i18n="modal.reset"></button>
                            <button type="button" onclick="delRoom()" class="btn btn-danger" data-i18n="modal.delete"></button>
                        ';
                    ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-i18n="modal.close"></button> 
                </div>
            </form>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="bookingOffCanvas" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel" data-i18n="rooms.offsidebar.title"></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body bg-dark" id="offCanvas-body">
  </div>
</div>
