<?php
error_reporting(E_ERROR | E_PARSE);
define('browsable', true);

include("object_Account.php");
include("object_Citizen.php");
session_start();

// if logged in account has not register a profile then head to index.php
if (isset($_SESSION['AccountInfo']) == false)
    header("location:javascript://history.go(-1)");
// if not have the right role then return to index
else if ($_SESSION['AccountInfo']->get_role() != 2)
    header("location:javascript://history.go(-1)");

// if there is not any profile was queried then head to index
if (isset($_SESSION['CitizenProfile']) == false)
    header("location:javascript://history.go(-1)");

$citizen = $_SESSION['CitizenProfile'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/CitizenVaccination.css">
    <link rel="stylesheet" href="css/filter-panel.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/CitizenVaccination.js"></script>
    <script src="js/WebElements.js"></script>
    <title>Tiêm chủng</title>
</head>

<body>
    <!-- HEADER -->
    <?php
    include("headerCitizen.php");
    ?>
    <!-- END HEADER -->

    <!-- NAV FUNCTION -->
    <?php
    include("function-navigation-bar.php");
    ?>
    <!-- END NAV FUNCTION -->
    <br>

    <!-- FUNCTION PANEL -->
    <div class="holder-function-panel">
        <div class="function-panel">
            <br>
            <div class="filter-panel">
                <div class="filter-pane" id="filter-org">
                    <label for="province-name">Tỉnh/Thành phố</label>
                    <select type="text" name="province-name" id="select-province">
                        <?php
                        echo '<option value="">' . $citizen->get_provincename() . '</option>';
                        $str = file_get_contents('local.json');
                        $local = json_decode($str, true); // decode the JSON into an associative array
                        $provincecode = -1;
                        for ($i = 0; $i < 63; $i++) {
                            if ($local[$i]['name'] != $citizen->get_provincename())
                                echo '<option value="' . $i . '">' . $local[$i]['name'] . '</option>';
                            else
                                $provincecode = $i;
                        }
                        echo '<script>
                        $("#select-province option:first-child").val(' . $provincecode . ');
                        $("#select-province option:first-child").after("<option value></option>");
                        </script>';
                        ?>
                    </select>
                    <label for="district-name">Quận/Huyện/Thị xã</label>
                    <select type="text" name="district-name" id="select-district">
                        <?php
                        echo '<option value="">' . $citizen->get_districtname() . '</option>';
                        $districtcode = -1;
                        $i = 0;
                        while (isset($local[$provincecode]['districts'][$i])) {
                            if ($local[$provincecode]['districts'][$i]['name'] != $citizen->get_districtname())
                                echo '<option value="' . $i . '">' . $local[$provincecode]['districts'][$i]['name'] . '</option>';
                            else
                                $districtcode = $i;
                            $i++;
                        }
                        echo '<script>
                        $("#select-district option:first-child").val(' . $districtcode . ')
                        $("#select-district option:first-child").after("<option value></option>");
                        </script>';
                        ?>
                    </select>

                    <label for="town-name">Xã/Phường/Thị trấn</label>
                    <select type="drop-down" name="town-name" id="select-town">
                        <?php
                        echo '<option value="">' . $citizen->get_townname() . '</option>';
                        $towncode = -1;
                        $i = 0;
                        while (isset($local[$provincecode]['districts'][$districtcode]['wards'][$i])) {
                            if ($local[$provincecode]['districts'][$districtcode]['wards'][$i]['name'] != $citizen->get_townname())
                                echo '<option value="' . $i . '">' . $local[$provincecode]['districts'][$districtcode]['wards'][$i]['name'] . '</option>';
                            else
                                $towncode = $i;
                            $i++;
                        }
                        echo '<script>
                        $("#select-town option:first-child").val(' . $towncode . ');
                        $("#select-town option:first-child").after("<option value></option>");

                        </script>';
                        ?>
                    </select>
                    <button class="btn-medium-bordered-icon btn-filter" id="btn-filter-org">
                        Tìm kiếm
                    </button>
                </div>


                <div class="filter-pane" id="filter-schedule">
                    <label for="start-date">Từ ngày</label>
                    <input type="date" name="start-date" id="start-date" min="<?php echo date("Y-m-d") ?>">

                    <label for="end-date">Đến ngày</label>
                    <input type="date" name="end-date" id="end-date">

                    <label for="vaccine">Vaccine</label>
                    <select type="text" name="vaccine" id="vaccine">
                        <option value="">Tất cả</option>
                        <option value="Astra">AstraZeneca</option>
                        <option value="Corminaty">Corminaty (Pfizer)</option>
                        <option value="Sputnik">Sputnik V</option>
                        <option value="Vero">Verro Cell</option>
                        <option value="Moderna">Moderna</option>
                    </select>
                </div>
            </div>

            <br>

            <div class="panel-list">
                <div class="list-name">
                    <div class="organization" id="list-name-org">Danh sách bệnh viện</div>
                    <div class="schedule" id="list-name-schedule">Danh sách lịch tiêm</div>
                </div>
                <br>

                <div class="holder">
                    <div class="list-object list-org" id="list-org">
                    </div>

                    <div class="list-object list-schedule" id="list-schedule">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END FUNCTION PANEL -->
    <br>

    <?php
    include("footer.php");
    include("WebElements.php");
    ?>
</body>

</html>