<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./assets/css/style.css"></link>
    <title>Hotel Management</title>
</head>
<body class="lao-font overflow-hidden">
    <?php 
        session_start(); 

        if(isset($_SESSION['username'])){
            if($_SESSION['username'] == 'admin') $admin = true;
            else $admin = false;
        }else{
            header("Location: login.php");
        }

        include_once("config/dbconnect.php");
        include "./views/nav.php"
    ?>

    <div class="d-flex overflow-hidden">
        <?php include "./views/sidebar.php"; ?>

        <div class="col-sm-10 main_box overflow-y-auto" style="background-color: #F5F8FA;" id="main_box">
            <main id="alert-box" class="en-font" style="z-index: 10;"></main>
            <?php
                if (isset($_GET['calender']) || empty($_GET)){
                    include_once("views/schedule.php");
            
                }else if(isset($_GET['booking'])){
                    include_once "views/booking.php";
                    
                }else if(isset($_GET['reserve'])){
                    include_once "views/reserve.php";
                    
                }else if(isset($_GET['rooms'])){
                    include_once "views/room.php";
                    
                }else if(isset($_GET['overview'])){
                    if($admin) include_once("views/reportOverview.php");
                    else include_once("views/404.php");
                    
                }else if(isset($_GET['revenue'])){
                    if($admin) include_once("views/reportRevenue.php");
                    else include_once("views/404.php");
                }
                else if(isset($_GET['setting'])){
                    if($admin) include_once("views/setting.php");
                    else include_once("views/404.php");
                }
            
                include_once("./views/bookingInfoModal.php")
            ?>
        </div>
    </div>

    <!-- jquery & bootstrap-->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>   
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- moment & data range js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- i18n js -->
    <script src="https://cdn.jsdelivr.net/npm/i18next@21.6.10/i18next.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-i18next@1.2.1/jquery-i18next.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/i18next-browser-languagedetector@6.1.3/i18nextBrowserLanguageDetector.min.js"></script>

    <!-- jsPDF and html2canvas -->    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <!-- app js -->
    <script src="./assets/js/i18n.js"></script>
    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/report.js"></script>
    <script src="./assets/js/dateRanger.js"></script>

</body>
</html>