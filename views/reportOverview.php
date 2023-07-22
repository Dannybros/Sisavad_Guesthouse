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
                            <span class="fw-semibold fs-6">Total Rooms</span>
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
                            <span class="fw-semibold fs-6">Room Types</span>
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
                            <span class="fw-semibold fs-6">Customers</span>
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
                            <span class="fw-semibold fs-6 ">Bookings</span>
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
                            <span class="fw-semibold fs-6 ">Employees</span>
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
                            <span class="fw-semibold fs-6 ">Total</span>
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
                    <h4 class="fw-bold py-2 mb-0">
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
                    <h4 class="fw-bold py-2 mb-0">
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
                    <h4 class="fw-bold py-2 mb-0">
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
                    <h4 class="fw-bold py-2 mb-0">
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
                    <h4 class="fw-bold py-2 mb-0">
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

                <div class="card-header">
                    <h3 class="card-title d-flex align-items-start flex-column mb-0">				
                        <span class="card-label fw-bold" style="color:#343a40">Bookings</span>
                        <span class="mt-1 fw-semibold fs-6 text-secondary">Top 5 with most fee</span>
                    </h3>
                </div>
                <!--end::Header-->

                <div class="card-body pt-6">             
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                            <thead>
                                <tr class="text-center text-secondary fw-bold text-uppercase gs-0">
                                    <th class="text-start">Order ID</th>
                                    <th class="min-w-100px">Created</th>
                                    <th class="min-w-125px">Customer</th>
                                    <th class="min-w-100px">Total</th>
                                    <th class="text-end">Status</th>
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
                                        <span class="fw-bold fs-6" style="color:#6c757d">245</span>                                
                                    </td>

                                    <td>
                                        <span class="fw-bold fs-6" style="color:#6c757d">$78.34</span>                                
                                    </td>
                                    
                                    <td>
                                        <span class="badge text-bg-success fs-base">                                
                                            9.2%
                                        </span>                                                                  
                                    </td>     

                                    <td class="text-end">
                                        <button class="btn btn-small bg-primary" style="transform: scale(0.8);">
                                            <i class="fa fa-arrow-right text-light"></i>                                
                                        </button>
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
                    <h3 class="card-title d-flex align-items-start flex-column mb-0">			
                        <span class="card-label fw-bold">Employees</span>
                        <span class="mt-1 fw-semibold fs-6 text-secondary" >Total: 38 people &nbsp; ( Male: 18 )</span>
                    </h3>

                    <button type="button" class="btn btn-secondary d-flex align-items-start justify-content-center" style="height: 30px; width:30px">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
                <!--end::Header-->

                <div class="card-body pt-6">             
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                            <thead>
                                <tr class="text-secondary fw-bold text-uppercase gs-0">
                                    <th class="text-start">Order ID</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>                            
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3">                                                   
                                                <img src="https://picsum.photos/200" style="width:50px; aspect-ratio:5/4" alt=""/>                                                   
                                            </div>
                                            
                                            <div class="d-flex justify-content-start flex-column">
                                                <div class="fw-bold fs-6">Guy Hawkins</div>
                                                <span class="fw-semibold d-block text-start text-body-tertiary">Haiti</span>
                                            </div>
                                        </div>                                
                                    </td>

                                    <td class="text-center">
                                        <span class="fw-bold fs-6" style="color:#6c757d">245</span>                                
                                    </td>

                                    <td class="text-center">
                                        <span class="fw-bold fs-6" style="color:#6c757d">$78.34%</span>                                
                                    </td>
                                    
                                    <td class="text-center">
                                        <span class="badge bg-danger">                                
                                            9.2%
                                        </span>                                                                  
                                    </td>     

                                    <td class="text-center">
                                        <button class="btn btn-small bg-primary" style="transform: scale(0.8);">
                                            <i class="fa fa-eye text-light"></i>                                
                                        </button>
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