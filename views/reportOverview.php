<section class="container" >
    <div class="row gy-5 gx-5">
        <div class="col-sm-6 col-xl-2 mb-xl-10 " >
            <div class="card px-3 py-2 h-lg-100 bg-white card-shadow overflow-hidden">
                <div class="card-body d-flex justify-content-between align-items-start flex-column">
                    <div class="m-0">
                        <i class="text-body-tertiary fs-4 fa fa-hotel" ></i>
                    </div>
                    <div class="d-flex flex-column mt-3 text-secondary text-start">
                        <span class="fw-semibold fs-1 lh-1 counter" style="color: #3F4254; font-family:Helvetica"> 37 </span>
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
                        <span class="fw-semibold fs-1 lh-1 counter" style="color: #3F4254; font-family:Helvetica"> 5 </span>
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
                        <span class="fw-semibold fs-1 lh-1 counter" style="color: #3F4254; font-family:Helvetica"> 20 </span>
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
                        <i class="text-body-tertiary fs-4 fa fa-book" ></i>
                    </div>
                    <div class="d-flex flex-column mt-3 text-secondary text-start">
                        <span class="fw-semibold fs-1 lh-1 counter" style="color: #3F4254; font-family:Helvetica"> 220 </span>
                        <div class="m-0">
                            <span class="fw-semibold fs-6" data-i18n="report.overview.span4">Bookings</span>
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
                        <span class="fw-semibold fs-1 lh-1 counter" style="color: #3F4254; font-family:Helvetica"> 9 </span>
                        <div class="m-0">
                            <span class="fw-semibold fs-6" data-i18n="report.overview.span5">Employees</span>
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
                        <div class="fw-semibold fs-1 lh-1" style="color: #3F4254; font-family:Helvetica"><span class="counter text-decoration-none">21</span>M </div>
                        <div class="m-0">
                            <span class="fw-semibold fs-6" data-i18n="report.overview.span6">Total</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-5 gx-2"> 

        <div class="col-xl-3">
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-bold py-2 mb-0" data-i18n="report.overview.graph.donut">
                        Current Room Status
                    </h4>
                </div>
                <div class="card-body d-flex">
                    <canvas id="room_status_donut"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-bold py-2 mb-0" data-i18n="report.overview.graph.pie">
                        Room Type Percentage
                    </h4>
                </div>
                <div class="card-body">
                    <canvas id="room_type_pie"></canvas>
                </div>
            </div>
        </div>       
        <div class="col-xl-6">
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-bold py-2 mb-0" data-i18n="report.overview.graph.line">
                        Annual Income
                    </h4>
                </div>
                <div class="card-body">
                    <canvas id="annual_revenue_line"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-5 g-xl-10">        
        <div class="col-xl-4">
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-bold py-2 mb-0" data-i18n="report.overview.graph.radar">
                        Room Popularity
                    </h4>
                </div>
                <div class="card-body">
                    <canvas id="popularity_radar"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-bold py-2 mb-0" data-i18n="report.overview.graph.bar">
                        Most Popular Room
                    </h4>
                </div>
                <div class="card-body">
                    <canvas id="popular_room_bar"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-5 g-xl-10">        
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
                                <tr class="text-center">                            
                                    <td>
                                        <div class="d-flex justify-content-start flex-column">
                                            <div class="fw-bold fs-6 text-start en-font">Guy Hawkins</div>
                                            <span class="fw-semibold d-block text-body-tertiary text-start">(Unpaid)</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 en-font text-dark">2022-07-04</span>                                
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 en-font text-dark">2022-07-08</span>                                
                                    </td>
                                    <td>
                                        <span class="fw-bold fs-6 en-font text-dark">200,000 KIP</span>                                
                                    </td>
                                    <td>
                                        <span class="badge text-bg-success fs-base"> Finished </span>                                                                  
                                    </td>  
                                </tr>
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
                            <label>
                                <span data-i18n="report.overview.span6">Total</span>: 
                                <span> 38 </span>
                                <span data-i18n="report.overview.graph.table.tb2.people"> People</span>
                            </label>
                            ( <label>
                                <span data-i18n="report.overview.graph.table.tb2.male">Male</span>: 
                                <span>18</span>
                            </label> )
                        </span>
                    </h5>

                    <a href="index.php?setting" class="btn btn-secondary d-flex align-items-center justify-content-center" style="height: 30px; width:30px">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
                <!--end::Header-->

                <div class="card-body pt-2">             
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle mb-1 en-font">
                            <thead>
                                <tr class="text-secondary fw-bold text-uppercase">
                                    <th class="text-start" data-i18n="setting.staff.name">Name</th>
                                    <th class="text-center" data-i18n="setting.staff.position">Position</th>
                                    <th class="text-center" data-i18n="setting.staff.email">Email</th>
                                    <th class="text-center" data-i18n="setting.staff.phone">Phone</th>
                                    <th class="text-center" data-i18n="setting.staff.passport">ID/Passport</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>                            
                                    <td>
                                        <div class="d-flex justify-content-start flex-column en-font">
                                            <div class="fw-bold fs-6 text-start">Guy Hawkins</div>
                                            <span class="fw-semibold d-block text-start text-body-tertiary">e123i2o3</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold fs-6">245</span>                                
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold fs-6">$78.34%</span>                                
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold fs-6">245</span>                                
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold fs-6">$78.34%</span>                                
                                    </td>
                                </tr>
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