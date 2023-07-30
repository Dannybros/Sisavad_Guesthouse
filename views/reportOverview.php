<section class="container" id="overview_report">
    <?php
        $sql = "SELECT 
        ( SELECT COUNT(*) FROM customer ) AS customers, 
        ( SELECT COUNT(*) FROM employee ) AS employees, 
        ( SELECT COUNT(*) FROM room ) AS rooms, 
        ( SELECT COUNT(*) FROM room_type ) AS room_types, 
        ( SELECT COUNT(*) FROM booking WHERE booking_status <> 'Cancelled' ) AS bookings,
        ( SELECT SUM(total_payment) FROM booking WHERE booking_status <> 'Cancelled' ) AS total
        ";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="row gy-5 gx-5">
                <div class="col-sm-6 col-xl-2 mb-xl-10 " >
                    <div class="card px-3 py-2 h-lg-100 bg-white card-shadow overflow-hidden">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <i class="text-body-tertiary fs-4 fa fa-hotel" ></i>
                            </div>
                            <div class="d-flex flex-column mt-3 text-secondary text-start">
                                <span class="fw-semibold fs-1 lh-1 counter" style="color: #3F4254; font-family:Helvetica">
                                    <?php echo $row["rooms"]?>
                                </span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6" data-i18n="report.overview.span1">Total Rooms</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10" >
                    <div class="card px-3 py-2 h-lg-100 bg-white card-shadow overflow-hidden">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <i class="text-body-tertiary fs-4 fa fa-th" ></i>
                            </div>
                            <div class="d-flex flex-column mt-3 text-secondary text-start">
                                <span class="fw-semibold fs-1 lh-1 counter" style="color: #3F4254; font-family:Helvetica">
                                    <?php echo $row["room_types"]?>
                                </span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6" data-i18n="report.overview.span2">Room Types</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10" >
                    <div class="card px-3 py-2 h-lg-100 bg-white card-shadow overflow-hidden">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <i class="text-body-tertiary fs-4 fa fa-user" ></i>
                            </div>
                            <div class="d-flex flex-column mt-3 text-secondary text-start">
                                <span class="fw-semibold fs-1 lh-1 counter" style="color: #3F4254; font-family:Helvetica"> 
                                    <?php echo $row["customers"]?>    
                                </span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6" data-i18n="report.overview.span3">Customers</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10" >
                    <div class="card px-3 py-2 h-lg-100 bg-white card-shadow overflow-hidden">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <i class="text-body-tertiary fs-4 fa fa-users" ></i>
                            </div>
                            <div class="d-flex flex-column mt-3 text-secondary text-start">
                                <span class="fw-semibold fs-1 lh-1 counter" style="color: #3F4254; font-family:Helvetica">
                                    <?php echo $row["employees"]?>
                                </span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6" data-i18n="report.overview.span5">Employees</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10" >
                    <div class="card px-3 py-2 h-lg-100 bg-white card-shadow overflow-hidden">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <i class="text-body-tertiary fs-4 fa fa-book" ></i>
                            </div>
                            <div class="d-flex flex-column mt-3 text-secondary text-start">
                                <span class="fw-semibold fs-1 lh-1 counter" style="color: #3F4254; font-family:Helvetica"> 
                                    <?php echo $row["bookings"]?>
                                </span>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6" data-i18n="report.overview.span4">Bookings</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card px-3 py-2 h-lg-100 bg-white card-shadow overflow-hidden">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <div class="m-0">
                                <i class="text-body-tertiary fs-4 fa fa-money" ></i>
                            </div>
                            <div class="d-flex flex-column mt-3 text-secondary text-start">
                                <div class="fw-semibold fs-1 lh-1" style="color: #3F4254; font-family:Helvetica">
                                    <span class="counter text-decoration-none">
                                        <?php echo substr(round($row["total"], -6), 0, 2);?>
                                    </span>M 
                                </div>
                                <div class="m-0">
                                    <span class="fw-semibold fs-6" data-i18n="report.overview.span6">Total</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    ?>    

    <div class="row g-5 gx-2"> 
        <div class="col-xl-3">
            <div class="card card-shadow">
                <div class="card-header bg-white">
                    <h5 class="fw-bold py-2 mb-0" data-i18n="report.overview.graph.donut">
                        Current Room Status
                    </h5>
                </div>
                <div class="card-body d-flex">
                    <canvas id="room_status_donut"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card card-shadow">
                <div class="card-header bg-white">
                    <h5 class="fw-bold py-2 mb-0" data-i18n="report.overview.graph.pie">
                        Room Type Percentage
                    </h5>
                </div>
                <div class="card-body">
                    <div id="room_type_pie" ></div>
                </div>
            </div>
        </div>  
        <div class="col-xl-6">
            <div class="card card-shadow" style="height: 325px;">
                <div class="card-header bg-white">
                    <h5 class="fw-bold py-2 mb-0" data-i18n="report.overview.graph.line">
                        Income
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="annual_revenue_line"></canvas>
                </div>
            </div>
        </div>
       
       
    </div>

    <div class="row g-5"> 
        <div class="col-12">
            <div class="card card-shadow">
                <div class="card-header bg-white  d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold py-2 mb-0 mt-2 " data-i18n="report.overview.graph.bar">
                        Most Popular Room
                    </h4>
                    <select class="form-select form-select-sm" style="width: 200px; height:40px; font-size: 15px;" onchange="reportRoomsPopular(this.value)">
                        <option selected value="count" data-i18n="report.overview.graph.choice1"></option>
                        <option value="revenue" data-i18n="report.overview.graph.choice2"></option>
                    </select>
                </div>
                <div class="card-body">
                    <canvas id="popular_room_bar" style="height: 400px;"></canvas>
                </div>
            </div>
        </div> 
    </div>

    <div class="row g-5">        
        <div class="col-xl-6">
            <div class="card card-flush h-lg-100">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title d-flex align-items-start flex-column mb-0">				
                        <span class="card-label fw-bold" style="color:#343a40" data-i18n="report.overview.span4">Bookings</span>
                        <span class="mt-1 fw-semibold fs-6 text-secondary" data-i18n="report.overview.graph.table.tb1">Top 5 with most fee</span>
                    </h5>
                    <a href="index.php?booking" class="btn btn-secondary d-flex align-items-center justify-content-center" style="height: 30px; width:30px">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
                <!--end::Header-->

                <div class="card-body pt-2">             
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle mb-1">
                            <thead>
                                <tr class="text-center text-secondary fs-base fw-bold text-uppercase">
                                    <th class="text-start en-font"> ID</th>
                                    <th class="en-font">Check In</th>
                                    <th class="en-font">Check Out</th>
                                    <th data-i18n="booking.table.total">Total</th>
                                    <th data-i18n="booking.table.status">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM booking NATURAL JOIN employee ORDER BY total_payment DESC LIMIT 5";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)) { 
                                        $status = $row['booking_status'];

                                        if($status=="Finished") $bg="bg-success";
                                        if($status=="Staying") $bg="bg-primary";
                                        if($status=="Reserved") $bg="bg-warning";
                                ?>

                                    <tr class="text-center" style="font-size: 14px;">                            
                                        <td class="d-flex justify-content-start flex-column">
                                            <div class="fw-bold text-start en-font"><?php echo $row['booking_id']?></div>
                                            <span class="fw-semibold d-block text-body-tertiary text-start">(<?php echo $row['emp_Name']?>)</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold en-font text-dark"><?php echo $row['date_in']?></span>                                
                                        </td>
                                        <td>
                                            <span class="fw-bold en-font text-dark"><?php echo $row['date_out']?></span>                                
                                        </td>
                                        <td>
                                            <span class="fw-bold en-font text-dark"><?php echo number_format($row['total_payment'])?> KIP</span>                                
                                        </td>
                                        <td>
                                            <span class="badge <?php echo $bg?> pt-1" style="font-size: 13px;"> <?php echo $status?> </span>                                                                  
                                        </td>  
                                    </tr>
                                <?php } ?>
                            </tbody>    
                        </table>
                    </div>
                    <!--end::Table--> 
                </div>
                <!--end: Card Body-->
            </div>
        </div>
        
        <div class="col-xl-6">
            <div class="card card-flush h-lg-100">
                
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title d-flex align-items-start flex-column mb-0">			
                        <span class="card-label fw-bold" data-i18n="report.overview.span5">Employees</span>
                        <span class="mt-1 fw-semibold fs-6 text-secondary">
                            <?php
                                $sql = "SELECT COUNT(*) AS Total,
                                    COUNT(CASE WHEN gender = 'Female' THEN 1 END) AS female,
                                    COUNT(CASE WHEN gender = 'Male' THEN 1 END) AS male
                                    FROM employee
                                ";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) { 
                            ?>
                                <label>
                                    <span data-i18n="booking.table.total">Total</span>: 
                                    <span> <?php echo $row['Total']?> </span>
                                    <span data-i18n="report.overview.graph.table.tb2.people"> People</span>
                                </label>
                                ( <label>
                                    <span data-i18n="setting.staff.info.male">Male</span>: 
                                    <span><?php echo $row['male']?></span>
                                </label> )
                                ( <label>
                                    <span data-i18n="setting.staff.info.female">Male</span>: 
                                    <span><?php echo $row['female']?></span>
                                </label> )
                            <?php } ?>
                        </span>
                    </h5>

                    <a href="index.php?setting" class="btn btn-secondary d-flex align-items-center justify-content-center" style="height: 30px; width:30px">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
                <!--end::Header-->

                <div class="card-body pt-2">             
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle mb-1">
                            <thead>
                                <tr class="text-secondary fw-bold text-uppercase">
                                    <th class="text-start" data-i18n="setting.staff.info.name">Name</th>
                                    <th class="text-center" data-i18n="setting.staff.info.position">Position</th>
                                    <th class="text-center" data-i18n="setting.staff.info.email">Email</th>
                                    <th class="text-center" data-i18n="setting.staff.info.phone">Phone</th>
                                    <th class="text-center en-font">ID Card</th>
                                </tr>
                            </thead>

                            <tbody class="en-font">
                                <?php
                                    $sql = "SELECT * FROM employee LIMIT 5";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)) { 
                                ?>
                                    <tr style="font-size: 14px;">                            
                                        <td class="d-flex justify-content-start flex-column en-font">
                                            <div class="fw-bold text-start text-capitalize">
                                                <?php echo $row['emp_Name']?>
                                            </div>
                                            <div class="fw-semibold d-block text-start text-body-tertiary">
                                                Emloyee ID: <span> (<?php echo $row['emp_ID']?>)</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold"><?php echo $row['position']?></span>                                
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold"><?php echo $row['email']?></span>                                
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold"><?php echo $row['phone']?></span>                                
                                        </td>
                                        <td class="text-center">
                                            <span class="fw-bold"><?php echo $row['emp_ID_Card']?></span>                                
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>    
                        </table>
                    </div>
                    <!--end::Table--> 
                </div>
                <!--end: Card Body-->
            </div>
        </div>
    </div>
</section>