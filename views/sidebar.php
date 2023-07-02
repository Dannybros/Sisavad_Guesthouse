<section id="sidebar-collapse" class="col-sm-2 sidebar">
    
    <main class="profile_sidebar p-3 mb-2">
        <img src="https://picsum.photos/200" alt="">
        <div class="profile_name ms-3">
            <h3 class="text-light mb-3">
                GuestHouse
            </h3>
            <figure class="d-flex align-items-center text-light mb-0">
                <span class="green__circle me-3"></span>
                <?php 
                    date_default_timezone_set("Asia/Bangkok");
                    $date = date("Y/m/d");
                    $day = date('l');
                    echo "<b> $date &nbsp; ($day)</b>";
                ?>
            </figure> 
        </div>
    </main>

    <ul class="menu__box">
        <!-- <li class="p-2">
            <div class="row p-3 text-white rounded-2 menu_list <?php if (isset($_GET['schedule'])) echo 'active_list'?>" role="button" data-bs-toggle="collapse" data-bs-target="#submenu1" >
                <div class="col-10">
                    <i class="fa fa-user px-2">&nbsp;</i>
                    Schedule
                </div>
                <i class="fa fa-chevron-down col-2" aria-hidden="true"></i>
            </div>
            
            <div class="collapse ps-3 pb-0" id="submenu1">
                <a class="menu_list text-decoration-none row p-2 m-1 mt-2 text-white rounded-2 
                    <?php if (isset($_GET['calender'])) echo 'active_list'?>"
                    href="index.php?schedule&calender"
                >
                    <div>
                        <i class="fa fa-file px-2" aria-hidden="true">&nbsp;</i>
                        Calender
                    </div>
                </a>
                <a class="menu_list text-decoration-none row p-2 m-1 mt-2 text-white rounded-2 
                    <?php if (isset($_GET['booking'])) echo 'active_list'?>"
                    href="index.php?schedule&booking"
                >
                    <div>
                        <i class="fa fa-book px-2" aria-hidden="true">&nbsp;</i>
                        Booking
                    </div>
                </a>
            </div>
        </li> -->

        <li class="p-2" >
            <a class="menu_list text-decoration-none row p-3 text-white rounded-2 
                <?php if (isset($_GET['calender']) || empty($_GET)) echo 'active_list'?>"
                href="index.php?calender"
            >
                <div>
                    <i class="fa fa-book px-2">&nbsp;</i>
                    Schedule
                </div>
            </a>
        </li>

        <li class="p-2" >
            <a class="menu_list text-decoration-none row p-3 text-white rounded-2 
                <?php if (isset($_GET['booking'])) echo 'active_list'?>"
                href="index.php?booking"
            >
                <div>
                    <i class="fa fa-book px-2">&nbsp;</i>
                    Booking
                </div>
            </a>
        </li>
        
        <li class="p-2" >
            <a class="menu_list text-decoration-none row p-3 text-white rounded-2 
                <?php if (isset($_GET['reserve'])) echo 'active_list'?>"
                href="index.php?reserve"
            >
                <div>
                    <i class="fa fa-book px-2">&nbsp;</i>
                    Reserve
                </div>
            </a>
        </li>

        <li class="p-2" >
            <a class="menu_list text-decoration-none row p-3 text-white rounded-2 
                <?php if (isset($_GET['rooms'])) echo 'active_list'?>"
                href="index.php?rooms"
            >
                <div>
                    <i class="fa fa-hotel px-2">&nbsp;</i>
                    Rooms
                </div>
            </a>
        </li>

        <li class="p-2">
            <div class="row d-flex align-items-center p-3 text-white rounded-2 menu_list <?php if (isset($_GET['report'])) echo 'active_list'?>" 
                data-bs-toggle="collapse" 
                data-bs-target="#reportSubmenu" 
                aria-expanded="false" 
                onclick="reportBtnClick()"
                role="button" 
            >
                <div class="col-10">
                    <i class="fa fa-user px-2">&nbsp;</i>
                    Report
                </div>
                <i class="fa fa-chevron-right col-2 icon-rotate" aria-hidden="true"></i>
            </div>
            
            <div class="collapse ps-3 pb-0" id="reportSubmenu">
                <a class="menu_list text-decoration-none row p-2 m-1 mt-2 text-white rounded-2 
                    <?php if (isset($_GET['report'])) echo 'active_list'?>"
                    href="index.php?report&customer"
                >
                    <div>
                        <i class="fa fa-file px-2" aria-hidden="true">&nbsp;</i>
                        Customer
                    </div>
                </a>
                <a class="menu_list text-decoration-none row p-2 m-1 mt-2 text-white rounded-2 
                    <?php if (isset($_GET['revenue'])) echo 'active_list'?>"
                    href="index.php?report&revenue"
                >
                    <div>
                        <i class="fa fa-book px-2" aria-hidden="true">&nbsp;</i>
                        Revenue
                    </div>
                </a>
            </div>
        </li>
    </ul>

</section>
