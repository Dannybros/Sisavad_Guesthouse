<section class="container">
    <div class="row gy-5 gx-5">
        <div class="card px-3 py-2 h-00 bg-white card-shadow overflow-hidden">
            <div class="card-body d-flex justify-content-between position-relative py-0 border-bottom-2">
                <div>
                    <h3>Booking Status In A <span> WEEK </span></h3>
                </div>
                <ul class="nav nav-pills d-flex mt-3">
                    <li class="nav-item p-0 ms-0">
                        <a href="#" class="nav-link btn active px-0">                   
                            <span class="nav-text fw-semibold fs-4 mb-3">
                                1 week
                            </span> 
                            <span class="position-absolute z-index-2 w-100 h-2px start-0 bottom-0 bg-primary rounded" style="height: 2px;"></span>
                        </a>
                    </li>
                    <!--end::Item--> 

                    <li class="nav-item p-0 ms-0">
                        <a href="#" class="nav-link btn active px-0">                   
                            <span class="nav-text fw-semibold fs-4 mb-3">
                                1 month
                            </span> 
                            <span class="position-absolute z-index-2 w-100 h-2px start-0 bottom-0 bg-primary rounded" style="height: 2px;"></span>
                        </a>
                    </li>
                    <!--end::Item-->  
                    
                    <li class="nav-item p-0 ms-0">
                        <a href="#" class="nav-link btn active px-0" >                   
                            <span class="nav-text fw-semibold fs-4 mb-3">
                                Overview
                            </span> 
                            <span class="position-absolute z-index-2 w-100 h-2px start-0 bottom-0 bg-primary rounded" style="height: 2px;"></span>
                        </a>
                    </li>
                </ul>       
            </div>
        </div>
    </div>

    <div class="row g-5 g-xl-10"> 
        <div class="col-8">
            <div class="card card-shadow h-100">
                <div class="card-body d-flex">
                    <div id="main_booking_graph"></div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="d-block">
                <div class="card card-shadow h-100">
                    <div class="card-body fs-3">
                        <span> Revenue earned</span>
                        $360
                    </div>
                </div>
            </div> 
            <div class="d-block">
                <div class="card card-shadow h-100">
                    <div class="card-body fs-3">
                        <span> Total Bookings</span>
                        25
                    </div>
                </div>
            </div> 
        </div> 
    </div>

    <div class="row g-5 g-xl-10">        
        <div class="col-xl-6">
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-bold py-2 mb-0">
                        Room Popularity In A <span>Week</span>
                    </h4>
                </div>
                <div class="card-body">
                    <div id="booking_popularity_bar"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card card-shadow h-100">
                <div class="card-header bg-white">
                    <h4 class="fw-bold py-2 mb-0">
                        Most Popular Type In A <span>Week</span>
                    </h4>
                </div>
                <div class="card-body">
                    <canvas id="booking_popularity_pie"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-5 g-xl-10">        
        <div class="col-xl-6">
            <div class="card card-flush h-lg-100">

                <div class="card-header">
                    <h3 class="card-title d-flex align-items-start flex-column mb-0">				
                        <span class="card-label fw-bold" style="color:#343a40">Bookings (Reserved)</span>
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

                <div class="card-header">
                    <h3 class="card-title d-flex align-items-start flex-column mb-0">				
                        <span class="card-label fw-bold" style="color:#343a40">Bookings (Finished)</span>
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
        
        <div class="col-xl-4">
            <div class="card card-flush h-lg-100">

                <div class="card-header">
                    <h3 class="card-title d-flex align-items-start flex-column mb-0">				
                        <span class="card-label fw-bold" style="color:#343a40">Bookings (Finished)</span>
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
    </div>
    

</section>