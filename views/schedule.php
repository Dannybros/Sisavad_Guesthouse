<section id="schedule" onload="test()">

    <div class="title_box"> 
        <button class="btn btn-light left_month" onclick="goPrevMonth()">
            <i class="fa fa-chevron-left"></i>
        </button>
        <h1>
            Schedule For : 
            <span class="text-danger" id="schedule-month">
            </span>
        </h1>
        <button class="btn btn-light right_month" onclick="goNextMonth()">
            <i class="fa fa-chevron-right"></i>
        </button>
    </div>
    
    <table class="table table-bordered" id="calender">
        <thead id="calender_header" onload="test()">
        </thead>
        <tbody id="calender_body">
        </tbody>
    </table>
</section>