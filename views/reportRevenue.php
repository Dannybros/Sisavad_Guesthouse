<section class="container" id="report-revenue">
    <div class="row g-2">
        <div class="card px-3 py-2 h-00 bg-white card-shadow overflow-hidden">
            <div class="card-body d-flex justify-content-between align-items-center py-0 border-bottom-2">
                <div class="fs-3">
                   Booking Info ( <span class="period_title fw-bold text-capitalize">WEEK </span> )
                </div>
                <nav class="navbar-expand-lg">
                    <div class="navbar-nav">
                        <a class="nav-link mx-2 bg-body-tertiary" onclick="setActiveRevenuePeriod('1 week')">
                            <div class="px-2" role="button">
                                1W
                            </div>
                            <div class="opacity-100 postion-absolute bottom-0 start-0 w-100 bg-primary" style="height: 2px;"></div>
                        </a>
                        <a class="nav-link mx-2 bg-body-tertiary" onclick="setActiveRevenuePeriod('1 month')">
                            <div class="px-2" role="button">
                                1M
                            </div>
                            <div class="opacity-0 postion-absolute bottom-0 start-0 w-100 bg-primary" style="height: 2px;"></div>
                        </a>
                        <a class="nav-link mx-2 bg-body-tertiary" onclick="setActiveRevenuePeriod('1 months')">
                            <div class="px-2" role="button">
                                6M
                            </div>
                            <div class="opacity-0 postion-absolute bottom-0 start-0 w-100 bg-primary" style="height: 2px;"></div>
                        </a>
                        <a class="nav-link mx-2 bg-body-tertiary" onclick="setActiveRevenuePeriod('1 year')">
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
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between fw-bold px-3 py-2">
                        <div class="fs-5 text-capitalize">
                            Top 5 Popular Rooms
                        </div>
                        <div class="fs-5 text-secondary pe-none text-uppercase">(WEEK)</div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="booking_popularity_bar" class="mt-1"></div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between fw-bold px-3 py-2">
                        <div class="fs-5 text-capitalize">
                           Popular Room Types
                        </div>
                        <div class="fs-5 text-secondary pe-none text-uppercase">(WEEK)</div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="booking_popularity_pie" style="height: 220px;" class="revenue-chart"></div>
                </div>
            </div>
        </div>
        
        <div class="col-4 pe-0">
            <div class="card revenue-stats text-white h-100">
                <div class="card-header fs-4 border-0 z-4 my-2">Statistics</div>
                <div class="card-body row">
                    <div class="col-6 px-2">
                        <figure class="rounded p-3 mb-0" style="border: 1px dashed rgba(255, 255, 255, 0.4)">
                            <div class="fs-4 fw-bold">
                                $3,400
                            </div>
                            <div class="text-capitalize">
                                earned in a week
                            </div>
                        </figure>
                    </div>
                    <div class="col-6 px-2 ">
                        <figure class="rounded p-3 mb-0" style="border: 1px dashed rgba(255, 255, 255, 0.4)">
                            <div class="fs-4 fw-bold">
                                13
                            </div>
                            <div class="text-capitalize">
                                bookings in a week
                            </div>
                        </figure>
                    </div>
                    <div class="col-6 px-2 ">
                        <figure class="rounded p-3 mb-0" style="border: 1px dashed rgba(255, 255, 255, 0.4)">
                            <div class="fs-4 fw-bold">
                                A-101
                            </div>
                            <div class="text-capitalize">
                                most popular room
                            </div>
                        </figure>
                    </div>
                    <div class="col-6 px-2 ">
                        <figure class="rounded p-3 mb-0" style="border: 1px dashed rgba(255, 255, 255, 0.4)">
                            <div class="fs-4 fw-bold">
                                Sigle Room 
                            </div>
                            <div class="text-capitalize">
                               popular room type
                            </div>
                        </figure>
                    </div>
                    
                </div>
            </div>
        </div> 
    </div>

    <div class="row gy-5">        
        <div class="col-xl-6 ps-0">
            <div class="card card-flush h-lg-100">
                <div class="card-header d-flex justify-content-between align-items-center text-capitalize">
                    <div class="fw-bold">
                        <div class="fs-5 text-start">bookings</div>
                        <span class=" float-start text-body-tertiary" >(Only For Reserved)</span>
                    </div>
                    <a class="fw-bold text-decoration-none fs-base" href='index.php?booking'>
                        view more 
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="card-body pt-6">             
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle ">
                            <thead>
                                <tr class="text-center text-secondary fw-bold text-capitalize text-center fs-base">
                                    <th class="text-start">Name</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Duration</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="text-center">                            
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                <div class="fw-bold fs-6">Guy Hawkins</div>
                                                <span class="fw-semibold d-block text-body-tertiary text-start">Haiti</span>
                                            </div>
                                        </div>                                
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 text-secondary">2022 - 07 - 10</span>                                
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 text-secondary">2022 - 07 - 13</span>                                
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 text-secondary">3 Nights</span>                                
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 text-secondary">$78.34</span>                                
                                    </td>
                                    <td>
                                        <span class="badge text-bg-primary fs-base"> Reserved </span>                                                                  
                                    </td>  
                                </tr>
                            </tbody>    
                        </table>
                    </div>
                    <!--end::Table--> 
                </div>
            </div>
        </div>

        <div class="col-xl-6 pe-0">
            <div class="card card-flush h-lg-100">
                <div class="card-header d-flex justify-content-between align-items-center text-capitalize">
                    <div class="fw-bold">
                        <div class="fs-5 text-start">bookings</div>
                        <span class=" float-start text-body-tertiary" >(Only For Finished)</span>
                    </div>
                    <a class="fw-bold text-decoration-none fs-base" href='index.php?booking'>
                        view more 
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                   
                </div>

                <div class="card-body pt-6">             
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle ">
                            <thead>
                                <tr class="text-center text-secondary fw-bold text-capitalize text-center fs-base">
                                    <th class="text-start">Name</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Duration</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="text-center">                            
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                <div class="fw-bold fs-6">Guy Hawkins</div>
                                                <span class="fw-semibold d-block text-body-tertiary text-start">Haiti</span>
                                            </div>
                                        </div>                                
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 text-secondary">2022 - 07 - 10</span>                                
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 text-secondary">2022 - 07 - 13</span>                                
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 text-secondary">3 Nights</span>                                
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 text-secondary">$78.34</span>                                
                                    </td>
                                    <td>
                                        <span class="badge text-bg-success fs-base"> Finished </span>                                                                  
                                    </td>  
                                </tr>
                            </tbody>    
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>