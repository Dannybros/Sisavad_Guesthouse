<section class="container" id="revenue_report">
    <div class="row g-2">
        <div class="card px-3 py-2 h-00 bg-white card-shadow overflow-hidden">
            <div class="card-body d-flex justify-content-between align-items-center py-0 border-bottom-2">
                <div class="fs-3">
                    <span data-i18n="report.revenue.title"> Booking Info </span>
                    ( <span class="period_value fw-bold text-capitalize" data-i18n="report.revenue.duration.week">WEEK </span> )
                </div>
                <nav class="navbar-expand-lg">
                    <div class="navbar-nav en-font">
                        <a class="nav-link mx-2 bg-body-tertiary" onclick="setActiveRevenuePeriod('1w')">
                            <div class="px-2" role="button">
                                1W
                            </div>
                            <div class="opacity-100 postion-absolute bottom-0 start-0 w-100 bg-primary" style="height: 2px;"></div>
                        </a>
                        <a class="nav-link mx-2 bg-body-tertiary" onclick="setActiveRevenuePeriod('1m')">
                            <div class="px-2" role="button">
                                1M
                            </div>
                            <div class="opacity-0 postion-absolute bottom-0 start-0 w-100 bg-primary" style="height: 2px;"></div>
                        </a>
                        <a class="nav-link mx-2 bg-body-tertiary" onclick="setActiveRevenuePeriod('6m')">
                            <div class="px-2" role="button">
                                6M
                            </div>
                            <div class="opacity-0 postion-absolute bottom-0 start-0 w-100 bg-primary" style="height: 2px;"></div>
                        </a>
                        <a class="nav-link mx-2 bg-body-tertiary" onclick="setActiveRevenuePeriod('1y')">
                            <div class="px-2" role="button">
                                1Y
                            </div>
                            <div class="opacity-0 postion-absolute bottom-0 start-0 w-100 bg-primary" style="height: 2px;"></div>
                        </a>
                    </div>
                </nav> 
            </div>
        </div>
    </div>

    <div class="row g-3"> 
        <div class="card card-shadow">
            <div class="card-body d-flex">
                <div id="main_booking_graph" class="w-100"></div>
            </div>
        </div>
    </div>

    <div class="row gy-4">  
        <div class="col-4 ps-0">
            <div class="card revenue-stats text-white h-100">
                <div class="card-header fs-4 border-0 z-4 my-2" data-i18n="report.revenue.statistics.title">Statistics</div>
                <div class="card-body row">
                    <div class="col-6 px-2">
                        <figure class="rounded p-3 mb-0" style="border: 1px dashed rgba(255, 255, 255, 0.4)">
                            <div class="fs-5 fw-bold en-font">
                                <span class="counter" id="revenue_total">100</span> (K)
                            </div>
                            <div class="text-capitalize">
                                <span data-i18n="report.revenue.statistics.stat1"> Earned In </span>
                                <span class="period_value" data-i18n="report.revenue.duration.week"> WEEK </span>
                            </div>
                        </figure>
                    </div>
                    <div class="col-6 px-2 ">
                        <figure class="rounded p-3 mb-0" style="border: 1px dashed rgba(255, 255, 255, 0.4)">
                            <div class="fs-5 fw-bold en-font counter" id="bookings_total">
                                10
                            </div>
                            <div class="text-capitalize">
                                <span data-i18n="report.revenue.statistics.stat2">Bookings In</span>
                                <span class="period_value" data-i18n="report.revenue.duration.week">Week</span>
                            </div>
                        </figure>
                    </div>
                    <div class="col-6 px-2 ">
                        <figure class="rounded p-3 mb-0" style="border: 1px dashed rgba(255, 255, 255, 0.4)">
                            <div class="fs-5 fw-bold en-font" id="room_name_period">
                                A-101
                            </div>
                            <div class="text-capitalize" data-i18n="report.revenue.statistics.stat3">
                                most popular room
                            </div>
                        </figure>
                    </div>
                    <div class="col-6 px-2 ">
                        <figure class="rounded p-3 mb-0" style="border: 1px dashed rgba(255, 255, 255, 0.4)">
                            <div class="fs-5 fw-bold en-font" id="room_type_period">
                                Single Room 
                            </div>
                            <div class="text-capitalize" data-i18n="report.revenue.statistics.stat4">
                               popular Room type
                            </div>
                        </figure>
                    </div>
                    
                </div>
            </div>
        </div> 

        <div class="col-4">
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between fw-bold px-3 py-2">
                        <span class="fs-5 text-capitalize" data-i18n="report.revenue.graph.bar">
                            Top 5 Popular Rooms
                        </span>
                        <label class="fs-5 text-secondary pe-none text-uppercase">
                            (
                            <span class="period_value" data-i18n="report.revenue.duration.week">
                                (WEEK)
                            </span>
                            )
                        </label>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div id="booking_popularity_bar" class="mt-1"></div>
                </div>
            </div>
        </div>

        <div class="col-4 pe-0">
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between fw-bold px-3 py-2">
                        <div class="fs-5 text-capitalize" data-i18n="report.revenue.graph.pie">
                           Popular Room Types
                        </div>
                        <label class="fs-5 text-secondary pe-none text-uppercase">
                            (
                            <span class="period_value" data-i18n="report.revenue.duration.week">
                                (WEEK)
                            </span>
                            )
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <div id="booking_popularity_pie" style="height: 220px;" class="revenue-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-5">        
        <div class="col-12 ps-0">
            <div class="card card-flush h-lg-100">
                <div class="card-header d-flex justify-content-between align-items-center text-capitalize">
                    <div class="fw-bold">
                        <div class="fs-5 text-start" data-i18n="report.overview.span4">bookings</div>
                        <span class=" float-start text-body-tertiary" data-i18n="report.revenue.graph.table">(Top 10 booking)</span>
                    </div>
                    <a class="fw-bold text-decoration-none fs-base" href='index.php?booking'>
                        <span data-i18n="report.overview.graph.table.view">view more</span> 
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="card-body pt-6">             
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle ">
                            <thead>
                                <tr class="text-center text-secondary fw-bold text-capitalize text-center fs-base">
                                    <th class="text-start en-font"> ID</th>
                                    <th class="en-font">Check In</th>
                                    <th class="en-font">Check Out</th>
                                    <th data-i18n="booking.table.duration">Duration</th>
                                    <th data-i18n="rooms.info.price">Price</th>
                                    <th data-i18n="booking.table.total">Total</th>
                                    <th data-i18n="booking.table.status">Status</th>
                                </tr>
                            </thead>

                            <tbody id="period_bookings">
                                <?php
                                    $sql = "SELECT * FROM booking 
                                        NATURAL JOIN employee 
                                        WHERE booking_status <> 'Cancelled' AND date_in BETWEEN NOW() - INTERVAL 7 DAY AND NOW() 
                                        ORDER BY total_payment 
                                        DESC LIMIT 10;
                                    ";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)) { 
                                        $status = $row['booking_status'];

                                        if($status=="Finished"){
                                            $bg="bg-success";
                                            $stat_lang="booking.status.finish";
                                        }
                                        if($status=="Staying"){
                                            $bg="bg-primary";
                                            $stat_lang="booking.status.stay";
                                        }
                                        if($status=="Reserved"){
                                            $bg="bg-warning";
                                            $stat_lang="booking.status.reserve";
                                        }
                                ?>                           
                                    <tr class="text-center" style="font-size: 16px;">                            
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
                                            <span class="fw-bold en-font text-dark"><?php echo $row['duration']?></span>                                
                                            <span class="fw-bold" data-i18n="booking.table.night"></span>                                
                                        </td>
                                        <td>
                                            <span class="fw-bold en-font text-dark"><?php echo number_format($row['total_payment'] / $row['duration'])?> KIP</span>                                
                                        </td>
                                        <td>
                                            <span class="fw-bold en-font text-dark"><?php echo number_format($row['total_payment'])?> KIP</span>                                
                                        </td>
                                        <td>
                                            <span class="badge fw-light <?php echo $bg?> pt-1" style="font-size: 14px;" data-i18n=<?php echo $stat_lang?>></span>                                                                  
                                        </td>  
                                    </tr>
                                <?php } ?>
                            </tbody>    
                        </table>
                        <!--end::Table--> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>