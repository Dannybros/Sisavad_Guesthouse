<h1 class="pt-2 pb-3 room_page_nav">
    ROOMS INFO
</h1>

<div class="d-flex justify-content-between align-items-center room_search_bar p-2 border-bottom border-dark">
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

<section class="p-3 border-bottom border-dark">
    <figure class="d-flex m-0">
        <div class="d-flex mx-2">
            <div class="calender-legend bg-success bg-opacity-75"></div>
            <label>Free</label>
        </div>
        <div class="d-flex mx-2">
            <div class="calender-legend bg-primary bg-opacity-75"></div>
            <label>Occupied</label>
        </div>
        <div class="d-flex mx-2">
            <div class="calender-legend bg-warning bg-opacity-75"></div>
            <label>Reserved</label>
        </div>
        <div class="d-flex mx-2">
            <div class="calender-legend bg-danger bg-opacity-75"></div>
            <label>Maintanence</label>
        </div>
    </figure>
</section>

<div class="display_room row my-4 overflow-auto" id="display_room">
    <?php
        $room_query = "SELECT * FROM `room` NATURAL JOIN `room_type` ORDER BY room_name";
        $room_result = mysqli_query($conn, $room_query);
        while ($rooms = mysqli_fetch_assoc($room_result)) {
            
            if($rooms['room_status']==="Free"){
                $color = "bg-success";
            }
            else if ($rooms['room_status']==="Maintenance"){
                $color = "bg-danger";
            }
            else if ($rooms['room_status']==="Reserved"){
                $color = "bg-warning";
            }
            else{
                $color = "bg-primary"; 
            }
    ?>
        <main class="room_box p-3 rounded-10" id="room_box">
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
                    <button class="btn btn-success" 
                        onclick="viewRoomInfo('<?php echo $rooms['room_id']?>')"
                        data-bs-toggle="modal" 
                        data-bs-target="#roomModal" 
                    >
                        View
                    </button>
                    <?php
                    if($rooms['room_status']!=="Free" && $rooms['room_status']!=="Maintenance"){?>
                        <button class="btn btn-primary staff_icon" 
                            onclick="getRoomBookingList('<?php echo $rooms['room_id']?>')" 
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#bookingOffCanvas"
                        >
                            Booking
                        </button>
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

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="bookingOffCanvas" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Booking List</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body bg-dark" id="offCanvas-body">
    
  </div>
</div>
