<?php
error_reporting(E_ERROR | E_PARSE); //Turn off warnings, errors still be alerted.
/* define('browsable', true);  
Define a variable named browsable = true on every php pages that can be accessed by users.
Pages not defined this variable at first are checked the existence of its,
this trick is used to prevent the direct access to separated elements files (such as: header, footer, etc.).
Then the pages can be defined (or not) for the same using purpose.
*/
define('browsable', true);

/*
These included .php files mean the php code inside is stand right the place it is placed
At the very first lines of the code (before handling almost everything), 
there is an if statement used to check the existence of the variable named 'browsable'.
It means that only pages which defined the 'browsable' variable can access the included code.
Browser can not read these file alone because of the prevention has been set.
*/
include("object_Account.php");
include("object_Citizen.php");
include("object_Organization.php");
session_start();
$citizen = new Citizen();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta html-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/VaccinationStatistics.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/WebElements.js"></script>
    <!-- <script src="js/VaccinationStatistics.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Thống kê số liệu tiêm chủng</title>
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <!-- <link rel="stylesheet" href="css/meanmenu.min.css"> -->
    <!-- <link rel="stylesheet" href="css/ORGSchedule.css"> -->
</head>

<body>
    <div id="return-header">
        <?php
        if (isset($_SESSION['AccountInfo']) && $_SESSION['AccountInfo']->get_status() == 1) {
            switch ((int)$_SESSION['AccountInfo']->get_role()) {
                case 0:
                    if (isset($_SESSION['OrgProfile']) == false) {
                        include("OrgLoadProfile.php");
                    }
                    include("headerMOH.php");
                    break;
                case 1:
                    if (isset($_SESSION['OrgProfile']) == false) {
                        include("OrgLoadProfile.php");
                    }
                    include("headerORG.php");
                    break;
                case 2:
                    if (isset($_SESSION['CitizenProfile']) == false) {
                        include("CitizenLoadProfile.php");
                    }
                    include("headerCitizen.php");
                    break;
                default:
                    include("headerGeneral.php");
                    break;
            }
            // echo '<script>alert("' . $_SESSION['CitizenProfile']->get_fullname() . '")</script>';
        } else
            include("headerGeneral.php");
        ?>
    </div>

    <br>

    <!-- FUNCTION PANEL -->
    <div class="holder-function-panel">
        <div class="panel-1">

            <br>
            <!-- Filter result by date -->
            <div class="panel-target-citizen">
                <!-- <div class="filter-panel">
                        <div class="filter-pane" id="filter-schedule">
                            <label for="start-date">Từ ngày</label>
                            <input type="date" name="start-date" id="start-date">

                            <label for="end-date">Đến ngày</label>
                            <input type="date" name="end-date" id="end-date">
                    
                            <button class="btn-search" id="btn-filter-schedule">
                            <img src="image/filter-magnifier.png" alt="filter-magnifier">
                            Tìm kiếm
                            </button>  
                        </div>

                    </div>    -->
            </div>

            <!-- Data Overview -->
            <br>
            <div class="analytics-sparkle-area">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Dữ liệu số mũi sáng -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="analytics-sparkle-line reso-mg-b-30">
                                <div class="analytics-content">
                                    <h5>Số liều cơ bản hoàn thành</h5>
                                    <h2><span class="counter">184,960,007</span> <span class="tuition-fees">Mũi tiêm</span></h2>
                                    <span class="text-success">73.49%</span>
                                    <div class="progress m-b-0">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 73.49%;"> <span class="sr-only">20% Complete</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Số mũi chiều -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="analytics-sparkle-line reso-mg-b-30">
                                <div class="analytics-content">
                                    <h5>Số liều bổ sung/nhắc lại hoàn thành</h5>
                                    <h2><span class="counter">52,697,124</span> <span class="tuition-fees">Mũi tiêm</span></h2>
                                    <span class="text-danger">20.93%</span>
                                    <div class="progress m-b-0">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20.93%;"> <span class="sr-only">230% Complete</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Số mũi tối -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                                <div class="analytics-content">
                                    <h5>Số mũi tiêm hôm qua</h5>
                                    <h2><span class="counter">223,705</span> <span class="tuition-fees">Mũi tiêm</span></h2>
                                    <span class="text-info">8.88%</span>
                                    <div class="progress m-b-0">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 8.88%;"> <span class="sr-only">20% Complete</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tổng số mũi tiêm -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30">
                                <div class="analytics-content">
                                    <h5>Tổng số</h5>
                                    <h2><span class="counter">251,680,004</span> <span class="tuition-fees">Mũi tiêm</span></h2>
                                    <span class="text-inverse">97%</span>
                                    <div class="progress m-b-0">
                                        <div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:97%;"> <span class="sr-only">230% Complete</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--Statistical chart -->
                <br>
                <br>
                <br>
                <br>
                <br>
                <br><br><br>

                <div style="display: flex">
                    <h2 style="margin-left: 150px">Biểu đồ số ca bệnh năm 2022</h2>
                    <h2 style="margin-left: 270px">Biểu đồ số liệu tiêm chủng 2021</h2>
                </div>
                <div class='Chart-1'>
                    <div id='dvChart' style="display:inline-block">
                        <canvas id="myChart" style="width:100%;max-width:500px; display:inline; align-items: center;margin-left: 150px;margin-right: 50px"></canvas>
                    </div>

                    <div id='dvChart2' style="display:inline-block">
                        <canvas id="myChart-2" style="width:100%;max-width:500px; display:inline; align-items: center;margin-left: 28px;margin-right: 50px"></canvas>
                    </div>
                </div>
                <div style="margin-left: 150px; width: 5%">
                    <div>
                        <hr style="background-color: green;">
                        <hr style="background-color: blue;">
                        <hr style="background-color: red;">
                    </div>
                </div>
                <br>

                <!-- <div class='Chart-2'>

                    <div id='dvChart1' style="display:inline-block">
                        <canvas id="myChart-1" style="width:100%;max-width:500px; display:inline; align-items: center;margin-left: 28px;margin-right: 50px"></canvas>
                    </div>

                    <div id='dvChart3' style="display:inline-block">
                        <canvas id="myChart-3" style="width:100%;max-width:500px; display:inline; align-items: center;margin-left: 28px;margin-right: 50px"></canvas>
                    </div>
                </div> -->


                <div class='col-lg-12 col-md-12 border-bound pt-3' style='margin-left:15px; margin-right:15px; margin-bottom: 20px; box-shadow: 0 4px 12px 0 rgb(34 41 47 / 12%)'>
                    <div class="row">
                        <div class="col-12-bg-white">
                            <h2>Số liệu vaccine theo địa phương</h2>
                        </div>

                        <div class="col-12 bg-white overflow-auto" style="overflow: scroll;height: 600px;">
                            <table class="table-striped" style="min-width: 1000px;width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 42px;">STT</th>
                                        <th class="w100" style="width: 100px">Tỉnh/Thành phố</th>
                                        <th class="text-center">Dự kiến KH phân bổ</th>
                                        <th class="text-center">Phân bổ thực tế</th>
                                        <th class="text-center">Dân số &gt;= 18 tuổi</th>
                                        <th class="text-center">Số liều đã tiêm</th>
                                        <th class="text-center">Tỷ lệ dự kiến phân bổ theo kế hoạch/ dân số (&gt;= 18 tuổi)</th>
                                        <th class="text-center">Tỷ lệ đã phân bổ/ dân số (&gt;= 18 tuổi)</th>
                                        <th class="text-center">Tỷ lệ đã tiêm ít nhất 1 mũi/ dân số (&gt;= 18 tuổi)</th>
                                        <th class="text-center">Tỷ lệ tiêm chủng/ Vắc xin phân bổ thực tế</th>
                                        <th class="text-center">Tỷ lệ phân bổ vắc xin/Tổng số phân bổ cả nước</th>
                                    </tr>
                                </thead _ngcontent-vfw-c15>

                                <tbody style="height: 450px;">
                                    <!-- Ha Noi -->
                                    <tr class="ng-star-inserted" id="Ha-Noi">
                                        <td class="text-center" style="width: 42px;">1</td>
                                        <td class="text-left" style="width: 100px">Hà Nội </td>
                                        <td class="text-center">11,376,541</td>
                                        <td class="text-center">12,294,742</td>
                                        <td class="text-center">6,200,000</td>
                                        <td class="text-center">19,040,925</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">91.75 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 91.7463%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">99.15 %</small>
                                            <div class="progress" class="progress-1" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width: 99.1511%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">213.39 %</small>
                                            <div class="progress" class="progress-1" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 213.39%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">154.87 %</small>
                                            <div class="progress" class="progress-1" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 154.87%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">9.05%</small>
                                            <div class="progress" class="progress-1" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 9.05%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- HCM -->
                                    <tr class="ng-star-inserted" id="HCM">
                                        <td class="text-center" style="width: 42px;">2</td>
                                        <td class="text-left" style="width: 100px">Hồ Chí Minh </td>
                                        <td class="text-center">13,794,299</td>
                                        <td class="text-center">14,637,020</td>
                                        <td class="text-center">7,208,800</td>
                                        <td class="text-center">23,117,024</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95.68 %</small>
                                            <div class="progress" class="progress-1" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 95.68%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">101.52 %</small>
                                            <div class="progress" class="progress-1" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width: 101.52%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">225.91 %</small>
                                            <div class="progress" class="progress-1" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 225.91%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">157.94 %</small>
                                            <div class="progress" class="progress-1" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 157.94%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">10.8 %</small>
                                            <div class="progress" class="progress-1" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 10.8%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Thanh Hoa -->
                                    <tr class="ng-star-inserted" id="Thanh-Hoa">
                                        <td class="text-center" style="width: 42px;">3</td>
                                        <td class="text-left" style="width: 100px">Thanh Hóa </td>
                                        <td class="text-center">4,794,541</td>
                                        <td class="text-center">3,877,590</td>
                                        <td class="text-center">2,393,453</td>
                                        <td class="text-center">9,297,198</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">100.16%</small>
                                            <div class="progress" class="progress-1" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 100.16%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">81%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:81%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">238.72%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 238.72%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">239.77%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 239.77%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">2.85 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 2.85%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Nghe An -->
                                    <tr class="ng-star-inserted" id="Nghe-An">
                                        <td class="text-center" style="width: 42px;">4</td>
                                        <td class="text-left" style="width: 100px">Nghệ An</td>
                                        <td class="text-center">4,267,816</td>
                                        <td class="text-center">3,900,900</td>
                                        <td class="text-center">1,960,668</td>
                                        <td class="text-center">7,804,532</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">108.84%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:108.84%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">99.48%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width: 99.48%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">250.61%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 250.61%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">200.07%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 200.07%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">2.87%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 2.87%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Dong Nai -->
                                    <tr class="ng-star-inserted" id="Dong-Nai">
                                        <td class="text-center" style="width: 42px;">5</td>
                                        <td class="text-left" style="width: 100px">Đồng Nai </td>
                                        <td class="text-center">4,256,053</td>
                                        <td class="text-center">5,025,430</td>
                                        <td class="text-center">2,306,671</td>
                                        <td class="text-center">8,587,597</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92.26%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 92.26%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">108.93%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width: 108.93%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">283.17 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 283.17%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">170.88 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 170.88%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">3.7 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 3.7%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Binh-Duong -->
                                    <tr class="ng-star-inserted" id="Binh-Duong">
                                        <td class="text-center" style="width: 42px;">6</td>
                                        <td class="text-left" style="width: 100px">Bình Dương </td>
                                        <td class="text-center">3,550,283</td>
                                        <td class="text-center">4,772,470</td>
                                        <td class="text-center">2,008,929</td>
                                        <td class="text-center">7,233,613</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">88.36%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 88.36%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">118.78%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width: 118.78%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">257.73 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 257.73%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">151.57 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 151.57%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">3.51 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 3.51%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="ng-star-inserted" id="An-Giang">
                                        <td class="text-center" style="width: 42px;">7</td>
                                        <td class="text-left" style="width: 100px">An Giang </td>
                                        <td class="text-center">2,606,158</td>
                                        <td class="text-center">3,112,132</td>
                                        <td class="text-center">1,457,127</td>
                                        <td class="text-center">5,059,848</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">89.43 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 89.43%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">106.79 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width: 106.79%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">238.23%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 238.23%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">162.58%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 162.58%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">2.29 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 2.29%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Hai Duong -->
                                    <tr class="ng-star-inserted" id="Hai-Duong">
                                        <td class="text-center" style="width: 42px;">8</td>
                                        <td class="text-left" style="width: 100px">Hải Dương </td>
                                        <td class="text-center">2,598,385</td>
                                        <td class="text-center">2,025,640</td>
                                        <td class="text-center">1,344,063</td>
                                        <td class="text-center">4,571,543</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">96.66 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 96.66%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">75.36 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width: 75.36%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">240.51 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 240.51%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">225.68 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 225.68%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.49 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.49%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Dak Lak -->
                                    <tr class="ng-star-inserted" id="Dak-Lak">
                                        <td class="text-center" style="width: 42px;">9</td>
                                        <td class="text-left" style="width: 100px">Đắk Lắk </td>
                                        <td class="text-center">2,317,760</td>
                                        <td class="text-center">2,100,110</td>
                                        <td class="text-center">1,266,098</td>
                                        <td class="text-center">4,432,970</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">91.53 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 91.53%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">82.94%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width: 82.94%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">245.77 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 247.77%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">211.08 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 211.08%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.55 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.55%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Thai Binh -->
                                    <tr class="ng-star-inserted" id="Thai-Binh">
                                        <td class="text-center" style="width: 42px;">10</td>
                                        <td class="text-left" style="width: 100px">Thái Bình</td>
                                        <td class="text-center">2,526,449</td>
                                        <td class="text-center">1,893,980</td>
                                        <td class="text-center">1,373,070</td>
                                        <td class="text-center">4,244,451</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 92%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">68.97 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:68.97%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">212.03 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:212.03%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">224.1 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 224.1%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.39 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.39%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Hai Phong -->
                                    <tr class="ng-star-inserted" id="Hai-Phong">
                                        <td class="text-center" style="width: 42px;">11</td>
                                        <td class="text-left" style="width: 100px">Hải Phòng</td>
                                        <td class="text-center">2,857,279</td>
                                        <td class="text-center">2,767,400</td>
                                        <td class="text-center">1,411,495</td>
                                        <td class="text-center">5,699,337</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">101.21 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 101.21%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">98.03 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:98.03%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">269.3 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:269.3%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">205.95 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 205.95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">2.04 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 2.04%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Bac Giang -->
                                    <tr class="ng-star-inserted" id="Bac-Giang">
                                        <td class="text-center" style="width: 42px;">12</td>
                                        <td class="text-left" style="width: 100px">Bắc Giang</td>
                                        <td class="text-center">2,408,322</td>
                                        <td class="text-center">2,203,610</td>
                                        <td class="text-center">1,280,197</td>
                                        <td class="text-center">5,466,281</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">94.06 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 94.06%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">86.07 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:86.07%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">249.3 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:249.3%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">248.06 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 248.06%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.62 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.62%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Nam Dinh -->
                                    <tr class="ng-star-inserted" id="Nam-Dinh">
                                        <td class="text-center" style="width: 42px;">13</td>
                                        <td class="text-left" style="width: 100px">Nam Định</td>
                                        <td class="text-center">2,341,610</td>
                                        <td class="text-center">1,772,560</td>
                                        <td class="text-center">1,159,000</td>
                                        <td class="text-center">4,122,563</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">101.02 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 101.02%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">76.47 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:76.47%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">245.68 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:245.68%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">232.58 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 232.58%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.3 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.3%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <!-- Tien Giang -->
                                    <tr class="ng-star-inserted" id="Tien-Giang">
                                        <td class="text-center" style="width: 42px;">14</td>
                                        <td class="text-left" style="width: 100px">Tiền Giang</td>
                                        <td class="text-center">2,512,418</td>
                                        <td class="text-center">2,974,320</td>
                                        <td class="text-center">1,488,385</td>
                                        <td class="text-center">4,792,047</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">84.4 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 84.4%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">99.92 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:99.92%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">213.36 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:213.36%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">161.11 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 161.11%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">2.19 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 2.19%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Kien Giang -->
                                    <tr class="ng-star-inserted" id="Kien-Giang">
                                        <td class="text-center" style="width: 42px;">15</td>
                                        <td class="text-left" style="width: 100px">Kiên Giang</td>
                                        <td class="text-center">2,371,842</td>
                                        <td class="text-center">3,001,880</td>
                                        <td class="text-center">1,248,338</td>
                                        <td class="text-center">4,254,342</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">120.24 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:120.24%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">244.53 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:244.53%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">141.72 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width: 141.72%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">2.21 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 2.21%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Long An -->
                                    <tr class="ng-star-inserted" id="Long-An">
                                        <td class="text-center" style="width: 42px;">16</td>
                                        <td class="text-left" style="width: 100px">Long An</td>
                                        <td class="text-center">2,397,297</td>
                                        <td class="text-center">2,998,000</td>
                                        <td class="text-center">1,361,733</td>
                                        <td class="text-center">5,374,074</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">88.02%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 88.02%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">110.08 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:110.08%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">261.71 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:261.71%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">179.26 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:179.26%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">2.21 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 2.21%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Dong Thap -->
                                    <tr class="ng-star-inserted" id="Dong-Thap">
                                        <td class="text-center" style="width: 42px;">17</td>
                                        <td class="text-left" style="width: 100px">Đồng Tháp</td>
                                        <td class="text-center">2,244,402</td>
                                        <td class="text-center">2,705,690</td>
                                        <td class="text-center">1,181,264</td>
                                        <td class="text-center">4,263,509</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">114.53 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:114.53%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">261.57 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:261.57%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">157.58 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:157.58%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.99 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.99%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Gia Lai -->
                                    <tr class="ng-star-inserted" id="Gia-Lai">
                                        <td class="text-center" style="width: 42px;">18</td>
                                        <td class="text-left" style="width: 100px">Gia Lai</td>
                                        <td class="text-center">1,760,170</td>
                                        <td class="text-center">1,795,832</td>
                                        <td class="text-center">950,154</td>
                                        <td class="text-center">3,634,825</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92.63 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 92.63%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">94.5 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:94.5%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">260.47 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:260.47%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">202.4 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:202.4%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.32 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.32%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Quang Nam -->
                                    <tr class="ng-star-inserted" id="Quang-Nam">
                                        <td class="text-center" style="width: 42px;">19</td>
                                        <td class="text-left" style="width: 100px">Quảng Nam</td>
                                        <td class="text-center">1,966,932</td>
                                        <td class="text-center">2,149,770</td>
                                        <td class="text-center">1,250,469</td>
                                        <td class="text-center">3,709,231</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">78.65 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 78.65%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">85.96 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:85.96%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">200.25 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:200.25%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">172.54 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:172.54%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.58 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.58%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Binh Dinh -->
                                    <tr class="ng-star-inserted" id="Binh-Dinh">
                                        <td class="text-center" style="width: 42px;">20</td>
                                        <td class="text-left" style="width: 100px">Bình Định</td>
                                        <td class="text-center">1,966,752</td>
                                        <td class="text-center">1,902,530</td>
                                        <td class="text-center">1,110,818</td>
                                        <td class="text-center">3,760,483</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">88.53 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 88.53%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">85.64 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:85.64%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">229.1 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:229.1%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">197.66 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:197.66%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.4 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.4%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Phu Tho -->
                                    <tr class="ng-star-inserted" id="Phu-Tho">
                                        <td class="text-center" style="width: 42px;">21</td>
                                        <td class="text-left" style="width: 100px">Phú Thọ</td>
                                        <td class="text-center">1,894,260</td>
                                        <td class="text-center">1,729,400</td>
                                        <td class="text-center">1,029,489</td>
                                        <td class="text-center">3,665,600</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 92%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">83.99 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:83.99%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">241.36 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:241.36%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">211.96 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:211.96%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.27 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.27%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Bac Ninh -->
                                    <tr class="ng-star-inserted" id="Bac-Ninh">
                                        <td class="text-center" style="width: 42px;">22</td>
                                        <td class="text-left" style="width: 100px">Bắc Ninh</td>
                                        <td class="text-center">1,871,988</td>
                                        <td class="text-center">1,865,510</td>
                                        <td class="text-center">985,257</td>
                                        <td class="text-center">4,228,457</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">94.67 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:94.67%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">278.23 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:278.23%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">226.66 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:226.66%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.37 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width: 1.27%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Quang Ninh -->
                                    <tr class="ng-star-inserted" id="Quang-Ninh">
                                        <td class="text-center" style="width: 42px;">23</td>
                                        <td class="text-left" style="width: 100px">Quảng Ninh</td>
                                        <td class="text-center">1,778,123</td>
                                        <td class="text-center">2,121,498</td>
                                        <td class="text-center">1,013,446</td>
                                        <td class="text-center">3,943,816</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">87.73 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width: 87.73%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">104.67 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:104.67%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">243.81 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:243.81%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">185.9 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:185.9%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.56 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.56%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Lam Dong -->
                                    <tr class="ng-star-inserted" id="Lam-Dong">
                                        <td class="text-center" style="width: 42px;">24</td>
                                        <td class="text-left" style="width: 100px">Lâm Đồng</td>
                                        <td class="text-center">1,642,299</td>
                                        <td class="text-center">1,952,774</td>
                                        <td class="text-center">901,167</td>
                                        <td class="text-center">3,854,949</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">91.12 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:91.12%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">108.35 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:108.35%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">274.91 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:274.91%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">197.41%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:197.41%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.44 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.44%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Ha Tinh -->
                                    <tr class="ng-star-inserted" id="Ha-Tinh">
                                        <td class="text-center" style="width: 42px;">25</td>
                                        <td class="text-left" style="width: 100px">Hà Tĩnh</td>
                                        <td class="text-center">1,642,572</td>
                                        <td class="text-center">1,220,150</td>
                                        <td class="text-center">795,436</td>
                                        <td class="text-center">2,875,059</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">103.25 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:103.25%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">76.7 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:76.7%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">249.88 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:249.88%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">235.63%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:235.63%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.9 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.9%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Ben Tre -->
                                    <tr class="ng-star-inserted" id="Ben-Tre">
                                        <td class="text-center" style="width: 42px;">26</td>
                                        <td class="text-left" style="width: 100px">Bến Tre</td>
                                        <td class="text-center">1,863,239</td>
                                        <td class="text-center">1,882,520</td>
                                        <td class="text-center">980,652</td>
                                        <td class="text-center">3,752,916</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95.98 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:95.98%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">251.84 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:251.84%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">199.36%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:199.36%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.39 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.39%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Thai Nguyen -->
                                    <tr class="ng-star-inserted" id="Thai-Nguyen">
                                        <td class="text-center" style="width: 42px;">27</td>
                                        <td class="text-left" style="width: 100px">Thái Nguyên</td>
                                        <td class="text-center">1,693,856</td>
                                        <td class="text-center">1,271,330</td>
                                        <td class="text-center">918,061</td>
                                        <td class="text-center">3,361,656</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92.25 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:92.25%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">69.24 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:69.24%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">248.18 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:251.18%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">264.42%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:264.42%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.94 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.94%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Hung Yen -->
                                    <tr class="ng-star-inserted" id="Hung-Yen">
                                        <td class="text-center" style="width: 42px;">28</td>
                                        <td class="text-left" style="width: 100px">Hưng Yên</td>
                                        <td class="text-center">1,705,117</td>
                                        <td class="text-center">1,686,572</td>
                                        <td class="text-center">935,528</td>
                                        <td class="text-center">2,921,927</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">91.13 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:91.13%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">90.14 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:90.14%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">213.14 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:213.14%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">173.25%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:173.25%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.24 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.24%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Son La -->
                                    <tr class="ng-star-inserted" id="Son-La">
                                        <td class="text-center" style="width: 42px;">29</td>
                                        <td class="text-left" style="width: 100px">Sơn La</td>
                                        <td class="text-center">1,458,572</td>
                                        <td class="text-center">1,193,980</td>
                                        <td class="text-center">786,097</td>
                                        <td class="text-center">2,856,476</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92.77 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:92.77%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">75.94 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:75.94%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">247.7 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:247.7%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">239.24%</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:239.24%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.88 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.88%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Can Tho -->
                                    <tr class="ng-star-inserted" id="Can-Tho">
                                        <td class="text-center" style="width: 42px;">30</td>
                                        <td class="text-left" style="width: 100px">Cần Thơ</td>
                                        <td class="text-center">1,789,361</td>
                                        <td class="text-center">2,132,068</td>
                                        <td class="text-center">941,769</td>
                                        <td class="text-center">3,368,201</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">113.19 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:113.19%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">275 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:275%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">157.98 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:157.98%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.57 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.57%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Quang Ngai -->
                                    <tr class="ng-star-inserted" id="Quang-Ngai">
                                        <td class="text-center" style="width: 42px;">31</td>
                                        <td class="text-left" style="width: 100px">Quảng Ngãi</td>
                                        <td class="text-center">1,678,654</td>
                                        <td class="text-center">1,562,604</td>
                                        <td class="text-center">723,385</td>
                                        <td class="text-center">2,922,563</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">116.03 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:116.03%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">108.01 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:108.01%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">284.85 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:284.85%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">187.03 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:187.03%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.15 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.15%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Khanh Hoa -->
                                    <tr class="ng-star-inserted" id="Khanh-Hoa">
                                        <td class="text-center" style="width: 42px;">32</td>
                                        <td class="text-left" style="width: 100px">Khánh Hòa</td>
                                        <td class="text-center">1,695,222</td>
                                        <td class="text-center">1,886,770</td>
                                        <td class="text-center">901,731</td>
                                        <td class="text-center">3,457,177</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">94 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:94%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">104.62 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:104.62%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">255.75 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:255.75%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">183.23 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:183.23%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.39 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.39%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Binh Thuan -->
                                    <tr class="ng-star-inserted" id="Binh-Thuan">
                                        <td class="text-center" style="width: 42px;">33</td>
                                        <td class="text-left" style="width: 100px">Bình Thuận</td>
                                        <td class="text-center">1,592,509</td>
                                        <td class="text-center">1,701,850</td>
                                        <td class="text-center">865,494</td>
                                        <td class="text-center">2,929,066</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:92%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">98.32 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:98.32%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">248.21 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:248.21%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">172.11 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:172.11%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.25 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.25%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Soc Trang -->
                                    <tr class="ng-star-inserted" id="Soc-Trang">
                                        <td class="text-center" style="width: 42px;">34</td>
                                        <td class="text-left" style="width: 100px">Sóc Trăng</td>
                                        <td class="text-center">1,636,586</td>
                                        <td class="text-center">2,114,660</td>
                                        <td class="text-center">861,361</td>
                                        <td class="text-center">3,553,947</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">122.75 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:122.75%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">255.83 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:255.83%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">168.06 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:168.06%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.56 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.56%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Ca Mau -->
                                    <tr class="ng-star-inserted" id="Ca-Mau">
                                        <td class="text-center" style="width: 42px;">35</td>
                                        <td class="text-left" style="width: 100px">Cà Mau</td>
                                        <td class="text-center">1,629,385</td>
                                        <td class="text-center">1,677,630</td>
                                        <td class="text-center">857,571</td>
                                        <td class="text-center">3,313,526</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">97.81 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:97.81%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">244.53 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:244.53%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">197.51 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:197.51%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.24 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.24%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Tay Ninh -->
                                    <tr class="ng-star-inserted" id="Tay-Ninh">
                                        <td class="text-center" style="width: 42px;">36</td>
                                        <td class="text-left" style="width: 100px">Tây Ninh</td>
                                        <td class="text-center">1,658,187</td>
                                        <td class="text-center">2,055,900</td>
                                        <td class="text-center">954,662</td>
                                        <td class="text-center">3,057,930</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">86.85 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:86.85%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">107.68 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:107.68%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">231.5 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:231.5%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">148.74 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:148.74%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.51 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.51%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Vinh Phuc -->
                                    <tr class="ng-star-inserted" id="Vinh-Phuc">
                                        <td class="text-center" style="width: 42px;">37</td>
                                        <td class="text-left" style="width: 100px">Vĩnh Phúc</td>
                                        <td class="text-center">1,453,409</td>
                                        <td class="text-center">1,462,250</td>
                                        <td class="text-center">789,896</td>
                                        <td class="text-center">3,007,540</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:92%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92.56 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:92.56%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">244.05 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 244.05%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">205.68 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:205.68%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.08 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.08%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Ba Ria VT -->
                                    <tr class="ng-star-inserted" id="BRVT">
                                        <td class="text-center" style="width: 42px;">38</td>
                                        <td class="text-left" style="width: 100px">Bà Rịa - Vũng Tàu</td>
                                        <td class="text-center">1,563,924</td>
                                        <td class="text-center">2,034,410</td>
                                        <td class="text-center">891,244</td>
                                        <td class="text-center">3,039,800</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">87.74 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:87.74%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">114.13 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:114.13%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">244.9 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 244.9%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">149.42 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:149.42%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.5 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.5%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Da Nang -->
                                    <tr class="ng-star-inserted" id="Da-Nang">
                                        <td class="text-center" style="width: 42px;">39</td>
                                        <td class="text-left" style="width: 100px">Đà Nẵng</td>
                                        <td class="text-center">1,571,173</td>
                                        <td class="text-center">1,720,782</td>
                                        <td class="text-center">885,070</td>
                                        <td class="text-center">2,862,101</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">88.76 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:88.76%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">97.21 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:97.21%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">224.89 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 224.89%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">166.33 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:166.33%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.27 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.27%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Thua Thien Hue -->
                                    <tr class="ng-star-inserted" id="TTH">
                                        <td class="text-center" style="width: 42px;">40</td>
                                        <td class="text-left" style="width: 100px">Thừa Thiên Huế</td>
                                        <td class="text-center">1,481,288</td>
                                        <td class="text-center">1,616,626</td>
                                        <td class="text-center">779,911</td>
                                        <td class="text-center">2,802,408</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">94.97 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:94.97%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">103.64 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:103.64%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">241.93 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 241.93%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">173.35 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:173.35%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.19 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.19%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Vinh Long -->
                                    <tr class="ng-star-inserted" id="Vinh=Long">
                                        <td class="text-center" style="width: 42px;">41</td>
                                        <td class="text-left" style="width: 100px">Vĩnh Long</td>
                                        <td class="text-center">1,461,149</td>
                                        <td class="text-center">1,733,130</td>
                                        <td class="text-center">769,026</td>
                                        <td class="text-center">3,091,815</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">112.68 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:112.68%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">249.25 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width: 249.25%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">178.39 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:178.39%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.28 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.28%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Tra Vinh -->
                                    <tr class="ng-star-inserted" id="Tra-Vinh">
                                        <td class="text-center" style="width: 42px;">42</td>
                                        <td class="text-left" style="width: 100px">Trà Vinh</td>
                                        <td class="text-center">1,396,109</td>
                                        <td class="text-center">1,353,410</td>
                                        <td class="text-center">734,794</td>
                                        <td class="text-center">2,664,931</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92.09 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:92.09%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">241.1 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:241.1%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">196.9 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:196.9%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Binh Phuoc -->
                                    <tr class="ng-star-inserted" id="Binh-Phuoc">
                                        <td class="text-center" style="width: 42px;">43</td>
                                        <td class="text-left" style="width: 100px">Bình Phước</td>
                                        <td class="text-center">1,285,789</td>
                                        <td class="text-center">1,528,060</td>
                                        <td class="text-center">741,800</td>
                                        <td class="text-center">2,688,723</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">86.67 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:86.67%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">103 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:103%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">243.06 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:243.06%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">175.96 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:175.96%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">1.12 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:1.12%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <!-- Ninh Binh -->
                                    <tr class="ng-star-inserted" id="Ninh-Binh">
                                        <td class="text-center" style="width: 42px;">44</td>
                                        <td class="text-left" style="width: 100px">Ninh Bình</td>
                                        <td class="text-center">1,279,525</td>
                                        <td class="text-center">1,239,970</td>
                                        <td class="text-center">695,394</td>
                                        <td class="text-center">2,452,906</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:92%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">89.16 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:89.16%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">234.44 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:234.44%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">197.82 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:197.82%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.91 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.91%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!--  Phu Yen-->
                                    <tr class="ng-star-inserted" id="Phu-Yen">
                                        <td class="text-center" style="width: 42px;">45</td>
                                        <td class="text-left" style="width: 100px">Phú Yên</td>
                                        <td class="text-center">1,171,033</td>
                                        <td class="text-center">1,108,954</td>
                                        <td class="text-center">649,673</td>
                                        <td class="text-center">2,029,570</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">90.12 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:90.12%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">85.35 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:85.35%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">230.5 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:230.5%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">183.02 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:183.02%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.82 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.82%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Bac Lieu -->
                                    <tr class="ng-star-inserted" id="Bac-Lieu">
                                        <td class="text-center" style="width: 42px;">46</td>
                                        <td class="text-left" style="width: 100px">Bạc Liêu</td>
                                        <td class="text-center">1,275,056</td>
                                        <td class="text-center">1,269,690</td>
                                        <td class="text-center">572,580</td>
                                        <td class="text-center">2,232,909</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">111.34 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:111.34%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">110.87 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:110.87%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">255.16 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:255.16%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">175.86 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:175.86%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.93 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.93%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Quang Binh -->
                                    <tr class="ng-star-inserted" id="Quang-Binh">
                                        <td class="text-center" style="width: 42px;">47</td>
                                        <td class="text-left" style="width: 100px">Quảng Bình</td>
                                        <td class="text-center">1,135,015</td>
                                        <td class="text-center">978,810</td>
                                        <td class="text-center">611,974</td>
                                        <td class="text-center">1,942,352</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92.73 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:92.73%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">79.97 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:79.97%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">217.02 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:217.02%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">198.44 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:198.44%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.72 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.72%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Ha Giang -->
                                    <tr class="ng-star-inserted" id="Ha-Giang">
                                        <td class="text-center" style="width: 42px;">48</td>
                                        <td class="text-left" style="width: 100px">Hà Giang</td>
                                        <td class="text-center">1,145,979</td>
                                        <td class="text-center">1,128,820</td>
                                        <td class="text-center">490,008</td>
                                        <td class="text-center">2,009,451</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">116.93 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:116.93%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">115.18 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:115.18%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">239.63 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:239.63%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">178.01 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:178.01%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.83 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.83%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Hoa Binh -->
                                    <tr class="ng-star-inserted" id="Hoa-Binh">
                                        <td class="text-center" style="width: 42px;">49</td>
                                        <td class="text-left" style="width: 100px">Hòa Bình</td>
                                        <td class="text-center">1,100,234</td>
                                        <td class="text-center">1,046,120</td>
                                        <td class="text-center">553,424</td>
                                        <td class="text-center">2,165,479</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">99.4 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:99.4%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">94.51 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:94.51%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">254.78 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:254.78%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">207 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:207%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.77 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.77%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Ha Nam -->
                                    <tr class="ng-star-inserted" id="Ha-Nam">
                                        <td class="text-center" style="width: 42px;">50</td>
                                        <td class="text-left" style="width: 100px">Hà Nam</td>
                                        <td class="text-center">1,126,483</td>
                                        <td class="text-center">1,213,520</td>
                                        <td class="text-center">612,219</td>
                                        <td class="text-center">2,208,618</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:92%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">99.11 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:99.11%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">233.11 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:233.11%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">182 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:182%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.89 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.89%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Yen Bai -->
                                    <tr class="ng-star-inserted" id="Yen-Bai">
                                        <td class="text-center" style="width: 42px;">51</td>
                                        <td class="text-left" style="width: 100px">Yên Bái</td>
                                        <td class="text-center">1,039,328</td>
                                        <td class="text-center">1,034,300</td>
                                        <td class="text-center">510,271</td>
                                        <td class="text-center">2,211,316</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">101.84 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:101.84%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">101.35 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:101.35%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">267.64 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:267.64%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">213.8 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:213.8%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.76 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.76%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <!-- Tuyen Quang -->
                                    <tr class="ng-star-inserted" id="Tuyen-Quang">
                                        <td class="text-center" style="width: 42px;">52</td>
                                        <td class="text-left" style="width: 100px">Tuyên Quang</td>
                                        <td class="text-center">985,752</td>
                                        <td class="text-center">930,610</td>
                                        <td class="text-center">535,735</td>
                                        <td class="text-center">1,842,830</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:92%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">86.85 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:86.85%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">238.84 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:238.84%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">198.02 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:198.02%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.69 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.69%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Lang Son -->
                                    <tr class="ng-star-inserted" id="Lang-Son">
                                        <td class="text-center" style="width: 42px;">53</td>
                                        <td class="text-left" style="width: 100px">Lạng Sơn</td>
                                        <td class="text-center">1,017,262</td>
                                        <td class="text-center">1,117,220</td>
                                        <td class="text-center">558,242</td>
                                        <td class="text-center">1,898,232</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">91.11 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:91.11%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">100.07 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:100.07%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">229.05 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:229.05%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">169.91 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:169.91%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.82 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.82%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Hau Giang -->
                                    <tr class="ng-star-inserted" id="Lang-Son">
                                        <td class="text-center" style="width: 42px;">54</td>
                                        <td class="text-left" style="width: 100px">Hậu Giang</td>
                                        <td class="text-center">1,018,710</td>
                                        <td class="text-center">1,190,250</td>
                                        <td class="text-center">536,163</td>
                                        <td class="text-center">2,057,802</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">95 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:95%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">111 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:111%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">249.76 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:249.76%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">172.89 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:172.89%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.88 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.88%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Lao Cai -->
                                    <tr class="ng-star-inserted" id="Lao-Cai">
                                        <td class="text-center" style="width: 42px;">55</td>
                                        <td class="text-left" style="width: 100px">Lào Cai</td>
                                        <td class="text-center">856,325</td>
                                        <td class="text-center">933,550</td>
                                        <td class="text-center">445,164</td>
                                        <td class="text-center">2,013,325</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">96.18 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:96.18%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">104.85 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:104.85%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">277.3 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:277.3%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">215.66 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:215.66%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.69 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.69%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Quang Tri -->
                                    <tr class="ng-star-inserted" id="Quang-Tri">
                                        <td class="text-center" style="width: 42px;">56</td>
                                        <td class="text-left" style="width: 100px">Quảng Trị</td>
                                        <td class="text-center">786,243</td>
                                        <td class="text-center">848,182</td>
                                        <td class="text-center">463,442</td>
                                        <td class="text-center">1,485,193</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">84.83 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:84.83%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">91.51 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:91.51%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">230.67 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:230.67%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">175.1 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:175.1%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.62 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.62%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Dak Nong -->
                                    <tr class="ng-star-inserted" id="Dak-Nong">
                                        <td class="text-center" style="width: 42px;">57</td>
                                        <td class="text-left" style="width: 100px">Đắk Nông</td>
                                        <td class="text-center">723,091</td>
                                        <td class="text-center">819,420</td>
                                        <td class="text-center">324,067</td>
                                        <td class="text-center">1,646,214</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">111.57 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:111.57%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">126.43 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:126.43%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">327.64 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:327.64%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">200.9 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:200.9%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.6 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.6%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Dien Bien -->
                                    <tr class="ng-star-inserted" id="Dien-Bien">
                                        <td class="text-center" style="width: 42px;">58</td>
                                        <td class="text-left" style="width: 100px">Điện Biên</td>
                                        <td class="text-center">663,416</td>
                                        <td class="text-center">629,460</td>
                                        <td class="text-center">339,186</td>
                                        <td class="text-center">1,495,668</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">97.8 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:97.8%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92.79 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:92.79%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">283.92 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:283.92%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">237.61 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:237.61%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.46 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.46%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Ninh Thuan -->
                                    <tr class="ng-star-inserted" id="Ninh-Thuan">
                                        <td class="text-center" style="width: 42px;">59</td>
                                        <td class="text-left" style="width: 100px">Ninh Thuận</td>
                                        <td class="text-center">739,091</td>
                                        <td class="text-center">892,660</td>
                                        <td class="text-center">373,632</td>
                                        <td class="text-center">1,496,827</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">98.91 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:98.91%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">119.46 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:119.46%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">280.02 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:280.02%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">167.68 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:167.68%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.66 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.66%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Kon Tum -->
                                    <tr class="ng-star-inserted" id="Kon-Tum">
                                        <td class="text-center" style="width: 42px;">60</td>
                                        <td class="text-left" style="width: 100px">Kon Tum</td>
                                        <td class="text-center">611,388</td>
                                        <td class="text-center">621,200</td>
                                        <td class="text-center">338,741</td>
                                        <td class="text-center">1,328,077</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">90.24 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:90.24%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">91.69 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:91.69%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">257.93 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:257.93%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">213.79 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:213.79%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.46 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.46%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Cao Bang -->
                                    <tr class="ng-star-inserted" id="Cao-Bang">
                                        <td class="text-center" style="width: 42px;">61</td>
                                        <td class="text-left" style="width: 100px">Cao Bằng</td>
                                        <td class="text-center">678,910</td>
                                        <td class="text-center">550,460</td>
                                        <td class="text-center">368,973</td>
                                        <td class="text-center">1,222,940</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:92%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">74.59 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:74.59%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">233.69 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:233.69%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">222.17 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:222.17%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.41 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.41%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Lai Chau -->
                                    <tr class="ng-star-inserted" id="Lai-Chau">
                                        <td class="text-center" style="width: 42px;">62</td>
                                        <td class="text-left" style="width: 100px">Lai Châu</td>
                                        <td class="text-center">496,261</td>
                                        <td class="text-center">517,840</td>
                                        <td class="text-center">282,600</td>
                                        <td class="text-center">1,103,450</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">87.8 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:87.8%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">91.62 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:91.62%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">257.64 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:257.64%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">213.09 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:213.09%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.38 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.38%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Bac Kan -->
                                    <tr class="ng-star-inserted" id="Bac-Kan">
                                        <td class="text-center" style="width: 42px;">63</td>
                                        <td class="text-left" style="width: 100px">Bắc Kạn</td>
                                        <td class="text-center">409,198</td>
                                        <td class="text-center">343,170</td>
                                        <td class="text-center">220,169</td>
                                        <td class="text-center">712,025</td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">92.93 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(198, 83, 18); width:92.93%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">77.93 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(5, 147, 207); width:77.93%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">235.99 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(0, 136, 79); width:235.99%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">207.48 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(175, 134, 18); width:207.48%;">
                                                </div>
                                            </div>
                                        </td>

                                        <!--  -->
                                        <td class="text-center">
                                            <small class="d-flex w-100 clb">0.25 %</small>
                                            <div class="progress" style="position: relative;height: 14px; border-radius: 15px;">
                                                <div class="progress-bar" role="progressbar" style="height: 14px; border-radius: 15px; background-color: rgb(45, 33, 136); width:0.25%;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <br>



    </div>
    <!-- END FUNCTION PANEL -->

    <br>

    <!-- FOOTER -->
    <?php
    include("footer.php");
    include("WebElements.php");
    include("SignupLoginForm.php");
    ?>
    <!-- END FOOTER -->

</body>


<script src="js/VaccinationStatistics.js"></script>

</html>