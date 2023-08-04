<section id="sidebar-collapse" class="col-sm-2 sidebar">
    
    <main class="profile_sidebar p-3 mb-2">
        <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/375670158.jpg?k=aaa4a7916cf39db3b56e4ccf145773b51d6fed26534bd7409099a0355cd106c7&o=&hp=1" alt="">
        <div class="profile_name ms-3">
            <div class="fs-5 text-light mb-2">
                <span class="mb-0" data-i18n="sidebar.name"></span>
                (<span class="fs-6 text-capitalize"><?php echo $_SESSION['username'] ?></span>)
            </div>
            <figure class="d-flex align-items-center en-font text-light mb-0">
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

   

    <div class="menu_box">
        <ul class="menu_lists">
            <li class="p-2" >
                <a class="menu_list text-decoration-none row p-3 text-white rounded-2 
                <?php if (isset($_GET['calender']) || empty($_GET)) echo 'active_list'?>"
                    href="index.php?calender"
                >
                    <div>
                        <i class="fa fa-calendar px-2 me-3" style="width:20px">&nbsp;</i>
                        <span data-i18n="sidebar.menu1"></span>
                    </div>
                </a>
            </li>

            <li class="p-2" >
                <a class="menu_list text-decoration-none row p-3 text-white rounded-2 
                    <?php if (isset($_GET['booking'])) echo 'active_list'?>"
                    href="index.php?booking"
                >
                    <div>
                        <i class="fa fa-book px-2 me-3" style="width:20px"></i>
                        <span data-i18n="sidebar.menu2"></span>
                    </div>
                </a>
            </li>
            
            <li class="p-2" >
                <a class="menu_list text-decoration-none row p-3 text-white rounded-2 
                    <?php if (isset($_GET['rooms'])) echo 'active_list'?>"
                    href="index.php?rooms"
                >
                    <div>
                        <i class="fa fa-hotel px-2 me-3" style="width:20px"></i>
                        <span data-i18n="sidebar.menu3"></span>
                    </div>
                </a>
            </li>

            <li class="p-2" >
                <a class="menu_list text-decoration-none row p-3 text-white rounded-2 
                    <?php if (isset($_GET['reserve'])) echo 'active_list'?>"
                    href="index.php?reserve"
                >
                    <div>
                        <i class="fa fa-bookmark px-2 me-3" style="width:20px"></i>
                        <span data-i18n="sidebar.menu4"></span>
                    </div>
                </a>
            </li>

            <?php
                if($admin){
                    $active = $sub_menu_1 = $sub_menu_2 = '';

                    if (isset($_GET['report'])) $active = 'active_list';
                    if (isset($_GET['overview'])) $sub_menu_1 = 'active_list';
                    if (isset($_GET['revenue'])) $sub_menu_2 = 'active_list';

                    echo "
                        <li class='p-2'>
                            <div class='row d-flex align-items-center p-3 text-white rounded-2 menu_list $active' 
                                data-bs-toggle='collapse' 
                                data-bs-target='#reportSubmenu' 
                                aria-expanded='false' 
                                onclick='reportBtnClick()'
                                role='button' 
                            >
                                <div class='col-10'>
                                    <i class='fa fa-bar-chart px-2 me-3' style='width:20px'></i>
                                    <span data-i18n='sidebar.menu5.title'></span>
                                </div>
                                <i class='fa fa-chevron-right col-2 icon-rotate' aria-hidden='true'></i>
                            </div>
                            
                            <div class='collapse ps-3 pb-0' id='reportSubmenu'>
                                <a class='menu_list text-decoration-none row p-2 m-1 mt-2 text-white rounded-2 $sub_menu_1'
                                    href='index.php?report&overview'
                                >
                                    <div>
                                        <i class='fa fa-file px-2 me-3' style='width:20px'></i>
                                        <span data-i18n='sidebar.menu5.side_menu1'></span>
                                    </div>
                                </a>
                                <a class='menu_list text-decoration-none row p-2 m-1 mt-2 text-white rounded-2 $sub_menu_2'
                                    href='index.php?report&revenue'
                                >
                                    <div>
                                        <i class='fa fa-book px-2 me-3' style='width:20px'></i>
                                        <span data-i18n='sidebar.menu5.side_menu2'></span>
                                    </div>
                                </a>
                            </div>
                        </li>
                    ";
                }
            ?>
            
            <?php
                if($admin){
                    $active='';
                    if (isset($_GET['setting'])) $active = 'active_list';

                    echo ("
                    <li class='p-2'>
                        <a class='menu_list text-decoration-none row p-3 text-white rounded-2 $active'
                            href='index.php?setting'
                        >
                            <div>
                                <i class='fa fa-cog px-2 me-3' style='width:20px'></i>
                                <span data-i18n='sidebar.menu6'></span>
                            </div>
                        </a>
                    </li>
                    ");
                }
            ?>
        </ul>
    </div>
</section>
