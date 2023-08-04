<section id="schedule">
    <div class="title_box"> 
        <button class="btn btn-light left_month" onclick="goPrevMonth()">
            <i class="fa fa-chevron-left"></i>
        </button>
        <h1>
            <span data-i18n="schedule.title"></span>
            <span class="text-danger en-font" id="schedule-month"></span>
        </h1>
        <button class="btn btn-light right_month" onclick="goNextMonth()">
            <i class="fa fa-chevron-right"></i>
        </button>
    </div>

    <section class="d-flex justify-content-between px-5 my-3">
        <figure class="d-flex m-0">
            <div class="d-flex mx-2">
                <div class="calender-legend bg-success bg-opacity-75"></div>
                <label data-i18n="schedule.status.finish"></label>
            </div>
            <div class="d-flex mx-2">
                <div class="calender-legend bg-primary bg-opacity-75"></div>
                <label data-i18n="schedule.status.stay"></label>
            </div>
            <div class="d-flex mx-2">
                <div class="calender-legend bg-warning bg-opacity-75"></div>
                <label data-i18n="schedule.status.reserve"></label>
            </div>
        </figure>

        <figure class="d-flex m-0">
            <aside class="d-flex mx-2">
                <div class="calender-legend bg-success bg-opacity-75">
                    <div class="calender-sign bg-white"></div>
                </div>
                <label class="en-font">Checked In</label>
            </aside>

            <aside class="d-flex mx-2">
                <div class="calender-legend bg-success bg-opacity-75">
                    <div class="calender-sign bg-black"></div>
                </div>
                <labe class="en-font">Checked Out</label>
            </aside>

            <aside class="d-flex mx-2">
                <div class="calender-legend bg-success bg-opacity-75">
                    <div class="calender-sign bg-warning"></div>
                </div>
                <label data-i18n="schedule.movement.moved">Moved</label>
            </aside>
            <aside class="d-flex mx-2">
                <div class="calender-legend bg-success bg-opacity-75 text-white">
                    <i class="fa fa-money" style="font-size: 11px;" aria-hidden="true"></i>
                </div>
                <label data-i18n="schedule.movement.unpaid">Not Paid</label>
            </aside>
        </figure>
    </section>
    
    <table class="table table-bordered table-group-divider en-font" id="calender">
        <thead id="calender_header">
        </thead>
        <tbody id="calender_body">
        </tbody>
    </table>
</section>
