<section class="container">
    <div class="accordion" id="accordionSetting">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button fw-bold fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#roomTypeSetting" aria-expanded="true" aria-controls="roomTypeSetting" data-i18n="setting.type.title">
                    Room Type Setting
                </button>
            </h2>
            <div id="roomTypeSetting" class="accordion-collapse collapse show" data-bs-parent="#accordionSetting">
                <div class="accordion-body">
                    <table class="table table-row-dashed align-middle ">
                        <thead>
                            <tr>
                                <th scope="col" class="fs-5" data-i18n="setting.type.id">Room Type ID</th>
                                <th scope="col" class="fs-5" data-i18n="setting.type.name">Room Type Name</th>
                                <th scope="col" class="fs-5" data-i18n="setting.type.price">Room Type Price</th>
                                <th scope="col" class="fs-5" data-i18n="booking.table.action">Action</th>
                            </tr>
                        </thead>
                        <tbody id="roomType_tbody">
                            <?php
                                $sql = "SELECT * FROM `room_type`";
                                $result = mysqli_query($conn, $sql);

                                while($room_type=mysqli_fetch_array($result)){
                                    $id = $room_type['room_type_id'];
                                    $name = $room_type['room_type_name'];
                                    $price = $room_type['price']; ?>
                                    <tr class="text-center">  
                                        <td>
                                            <span class="fw-bold fs-6 en-font" style="color:#6c757d"> 
                                                <?php echo $id?> 
                                            </span>                                
                                        </td>
                                        <td>
                                            <span class="fw-bold fs-6" style="color:#6c757d">
                                                <?php echo $name?> 
                                            </span>                                
                                        </td>
                                        <td>
                                            <span class="badge text-bg-success fs-6 en-font" >                                
                                                <?php echo number_format($price)?> KIP
                                            </span>                                                                  
                                        </td>     
                                        <td>
                                            <button class="btn btn-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#roomTypeModal" 
                                                onclick="openRoomTypeModal('edit', '<?php echo $id?>', '<?php echo $name?>', '<?php echo $price?>')" 
                                            >
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button class="btn btn-danger" onclick="delRoomType('<?php echo $id?>')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php  }
                            ?>
                        </tbody>
                    </table>

                    <p class="text-start mt-3 mb-0">
                        <span data-i18n="setting.type.new">Click here to create new</span> 
                        <a  href="#" 
                            data-bs-toggle="modal" 
                            data-bs-target="#roomTypeModal" 
                            onclick="openRoomTypeModal('save', '<?php echo uniqid('rt')?>', '', '')" 
                            data-i18n="setting.type.value"
                        >
                            ROOM TYPE
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#staffSetting" aria-expanded="false" aria-controls="staffTypeSetting" data-i18n="setting.staff.title">
                    Employee Setting
                </button>
            </h2>
            <div id="staffSetting" class="accordion-collapse collapse" data-bs-parent="#accordionSetting">
                <div class="accordion-body">
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                        <thead>
                            <tr class="text-center text-secondary fw-bold text-uppercase gs-0">
                                <th class="text-start" data-i18n="setting.staff.info.name">Name</th>
                                <th data-i18n="setting.staff.info.phone">Phone</th>
                                <th data-i18n="setting.staff.info.email">Email</th>
                                <th data-i18n="setting.staff.info.position">Position</th>
                                <th data-i18n="setting.staff.info.salary">Salary</th>
                                <th data-i18n="booking.table.action">Action</th>
                            </tr>
                        </thead>

                        <tbody id="staff_tbody">
                            <?php
                                $sql = "SELECT * FROM `employee`";
                                $result = mysqli_query($conn, $sql);

                                while($emp=mysqli_fetch_array($result)){
                                    $id = $emp['emp_ID'];
                                    $name = $emp['emp_Name'];
                                    $gender = $emp['gender'];
                                    $idCard = $emp['emp_ID_Card'];
                                    $position = $emp['position'];
                                    $salary = $emp['salary'];
                                    $email = $emp['email'];
                                    $phone = $emp['phone'];
                                ?>

                                <tr class="text-center en-font">   
                                    <td>
                                        <div class="d-flex justify-content-start flex-column">
                                            <div class="fw-bold fs-6 text-capitalize text-start">
                                                <?php echo $name?>
                                            </div>
                                            <span class="fw-semibold d-block text-body-tertiary text-start">
                                                (<?php echo $idCard?>)
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="fw-bold fs-6" style="color:#6c757d">
                                            <?php echo $phone?>
                                        </span>                                
                                    </td>

                                    <td>
                                        <span class="fw-bold fs-6" style="color:#6c757d">
                                            <?php echo $email?>
                                        </span>                                
                                    </td>

                                    <td>
                                        <span class="fw-bold fs-6" style="color:#6c757d">
                                            <?php echo $position?>
                                        </span>                                
                                    </td>
                                    
                                    <td>
                                        <span class="badge text-bg-success fs-6">                                
                                            <?php echo number_format($salary)?> KIP
                                        </span>                                                                  
                                    </td>     

                                    <td>
                                        <button class="btn btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#staffModal" 
                                            onclick="openStaffModal('edit', '<?php echo $id?>', '<?php echo $name?>', '<?php echo $gender?>', '<?php echo $idCard?>', '<?php echo $phone?>', '<?php echo $email?>', '<?php echo $position?>', '<?php echo $salary?>')" 
                                        >
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger" onclick="delStaff('<?php echo $id?>')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php  }
                            ?>
                        </tbody>    
                    </table>

                    <p class="text-start mt-3">
                        <span data-i18n="setting.staff.new">Click here to create new </span>
                        <a href="#" 
                            onclick="openStaffModal('save', null, '', '', '', '', '', '')" 
                            data-bs-toggle="modal"  
                            data-bs-target="#staffModal"
                            data-i18n="setting.staff.value"
                        >
                            Employee
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- room type modal -->
<div class="modal fade" id="roomTypeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" data-i18n="setting.type.info">
                    Room Type Info
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row" style="height: auto; row-gap:20px;">
                <div class="col-12">
                    <label class="fw-bold" data-i18n="setting.type.id">Room Type ID</label>
                    <input type="text" class="form-control text-center en-font" id="roomType__id" disabled value=""/>
                </div>

                <div class="col-6">
                    <label class="fw-bold" data-i18n="setting.type.name">Room Type Name</label>
                    <input type="text" class="form-control text-center en-font" id="roomType__name" value=""/>
                </div>
                
                <div class="col-6">
                    <label class="fw-bold" data-i18n="setting.type.price">Room Price</label>
                    <input type="text" class="form-control text-center en-font" id="roomType__price"  value=""/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-i18n="modal.save" id="roomTypeButton" onclick="roomTypeManage()" class="btn btn-success text-capitalize">Save</button>
                <button type="button" data-i18n="modal.close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- staff modal -->
<div class="modal fade" id="staffModal" tabindex="-1" role="dialog" aria-labelledby="staffModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" data-i18n="setting.staff.modal">
                    Staff Info
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row" style="height: auto; row-gap:20px;">
                <div class="col-6">
                    <label class="fw-bold mb-1" data-i18n="setting.staff.info.name">Name</label>
                    <input type="text" class="form-control text-center en-font" id="staff__name" />
                </div>
                <div class="col-6">
                    <label class="fw-bold mb-1" data-i18n="setting.staff.info.gender">Gender</label>
                    <select id="genderSelect" class="form-select">
                        <option value="Male" selected data-i18n="setting.staff.info.male"></option>
                        <option value="Female" data-i18n="setting.staff.info.female"></option>
                    </select>
                </div>
                <div class="col-6">
                    <label class="fw-bold mb-1 en-font" data-i18n="setting.staff.info.id_card">ID Card</label>
                    <input type="text" class="form-control text-center en-font" id="staff__id_card" />
                </div>
                <div class="col-6">
                    <label class="fw-bold mb-1" data-i18n="setting.staff.info.phone">Phone</label>
                    <input type="text" class="form-control text-center en-font" id="staff__phone" />
                </div>
                <div class="col-6">
                    <label class="fw-bold mb-1" data-i18n="setting.staff.info.email">Email</label>
                    <input type="text" class="form-control text-center en-font" id="staff__email" />
                </div>
                <div class="col-6">
                    <label class="fw-bold mb-1" data-i18n="setting.staff.info.position">Position</label>
                    <input type="text" class="form-control text-center en-font text-capitalize" id="staff__position" />
                </div>
                <div class="col-6">
                    <label class="fw-bold mb-1" data-i18n="setting.staff.info.salary">Salary</label>
                    <input type="text" class="form-control text-center en-font" id="staff__salary" />
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" data-i18n="modal.save" id="staffBtn" onclick="staffManage()" class="btn btn-primary text-capitalize">Save</button>
                <button type="button" data-i18n="modal.close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>