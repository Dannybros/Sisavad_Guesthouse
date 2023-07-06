<section id="schedule">
    <div class="title_box"> 
        <button class="btn btn-light left_month" onclick="goPrevMonth()">
            <i class="fa fa-chevron-left"></i>
        </button>
        <h1 onclick="test()">
            Schedule For : 
            <span class="text-danger" id="schedule-month">
            </span>
        </h1>
        <button class="btn btn-light right_month" onclick="goNextMonth()">
            <i class="fa fa-chevron-right"></i>
        </button>
    </div>

    <section class="d-flex justify-content-between px-5 my-3">
        <figure class="d-flex m-0">
            <div class="d-flex mx-2">
                <div class="calender-legend bg-success bg-opacity-75"></div>
                <label>Finished</label>
            </div>
            <div class="d-flex mx-2">
                <div class="calender-legend bg-primary bg-opacity-75"></div>
                <label>Staying</label>
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

        <figure class="d-flex m-0">
            <aside class="d-flex mx-2">
                <div class="calender-legend bg-success bg-opacity-75">
                    <div class="calender-sign bg-white"></div>
                </div>
                <label>Checked In</label>
            </aside>

            <aside class="d-flex mx-2">
                <div class="calender-legend bg-success bg-opacity-75">
                    <div class="calender-sign bg-black"></div>
                </div>
                <label>Checked Out</label>
            </aside>

            <aside class="d-flex mx-2">
                <div class="calender-legend bg-success bg-opacity-75">
                    <div class="calender-sign bg-warning"></div>
                </div>
                <label>Moved</label>
            </aside>
            <aside class="d-flex mx-2">
                <div class="calender-legend bg-success bg-opacity-75 text-white">
                    <i class="fa fa-money" style="font-size: 11px;" aria-hidden="true"></i>
                </div>
                <label>Not Paid</label>
            </aside>
        </figure>
    </section>
    
    <table class="table table-bordered table-group-divider" id="calender">
        <thead id="calender_header">
        </thead>
        <tbody id="calender_body">
        </tbody>
    </table>
</section>
