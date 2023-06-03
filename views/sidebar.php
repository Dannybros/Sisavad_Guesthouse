<section id="sidebar-collapse" class="col-sm-3 sidebar">
    
    <main class="profile_sidebar p-3 mb-2">
        <img src="https://picsum.photos/200" alt="">
        <div class="profile_name ms-3">
            <h3 class="text-light mb-3">
                Many GuestHouse
            </h3>
            <figure class="d-flex align-items-center text-light mb-0">
                <span class="green__circle me-3"></span>
                <?php 
                    date_default_timezone_set("Asia/Bangkok");
                    $date = date("Y/m/d");
                    $day = date('l');
                    echo "Today is  &nbsp; <b> $date &nbsp; ($day)</b>";
                ?>
            </figure> 
        </div>
    </main>

    <ul class="menu__box">
        <li>
            <a href="index.php?schedule" class="menu__list <?php if (isset($_GET['schedule'])) echo 'active_list'?>">
                <em class="fa fa-building">&nbsp;</em>
                Hotel Schedule
            </a>
        </li>
        <li>
            <a href="index.php?booking" class="menu__list <?php if (isset($_GET['booking'])) echo 'active_list'?>">
                <em class="fa fa-book">&nbsp;</em>
                Booking
            </a>
        </li>
        <li>
            <a href="index.php?rooms" class="menu__list <?php if (isset($_GET['rooms'])) echo 'active_list'?>">
                <em class="fa fa-user">&nbsp;</em>
                Rooms
            </a>
        </li>
        <li>
            <a href="index.php?report" class="menu__list <?php if (isset($_GET['report'])) echo 'active_list'?>">
                <em class="fa fa-file">&nbsp;</em> 
                Report 
            </a>
        </li>
    </ul>

</section>
