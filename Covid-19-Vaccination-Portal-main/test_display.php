<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="test_display.css">
    <title>Document</title>
</head>

<body>
    <div class="header">
        <div class="header-alignment">
            <a href="index.php">
                <img src="image/CVM-Logo.png" alt="CVM-Logo">
                <span class="title">CỔNG THÔNG TIN TIÊM CHỦNG COVID-19</span>
            </a>

            <div class="nav">
                <div>
                    <ul>
                        <li>
                            <a class="menu-section" href="#">Khai báo</a>
                        </li>

                        <li>
                            <a class="menu-section" href="#">Tiêm chủng</a>
                        </li>

                        <li>
                            <a class="menu-section" href="#">Thống kê</a>
                        </li>
                    </ul>
                </div>
                <a href="#"><img src="image/Avatar-Citizen.png" alt=""></a>

            </div>
        </div>
    </div>

    <br>

    <div class="nav-func-pages">
        <div class="nav-func-title">
            <a href="VaccinationRegistration.php">Lịch đăng ký tiêm chủng</a>
        </div>
        <div class="nav-directory">
            <div class="directory">
                <a href="index.php">Trang chủ</a>
            </div>

            <div class="dicrectory">&nbsp;/&nbsp;</div>

            <div class="directory">
                <a href="VaccinationRegistration.php">Công dân</a>
            </div>

            <div class="dicrectory">&nbsp;/&nbsp;</div>

            <div class="directory-selected">
                <a href="VaccinationRegistration.php">Lịch đăng ký tiêm chủng</a>
            </div>
        </div>
    </div>

    <br>

    <div class="holder-function-panel">
        <div class="nav-panel">
            <br><br>
            <div class="title">Trang công dân</div>
            <div class="title-bg"></div>
            <br>
            <div class="menu">
                <ul class="list">
                    <br>
                    <li>Thông tin tài khoản</li><br>
                    <li>Thông tin công dân</li><br>
                    <li>Lịch đăng ký tiêm chủng</li><br>
                    <li>Chứng nhận tiêm chủng</li><br>
                    <li>Thêm người thân</li><br>
                </ul>
            </div>
        </div>

        <div class="function-panel">
            <br>
            <div class="panel-target-citizen">
                <p>Đối tượng: </p>
                <select name="" id="">
                    <option value="">Đặng Nghiệp Cường</option>
                    <option value="">Đỗ Thị Cúc Hoa</option>
                </select>
            </div>
            <br>
            <div class="filter-panel">
                <div class="filter-vaccine-time">
                    <label for="status">Trạng thái</label>
                    <select type="text" name="status">
                        <option value=""></option>
                        <option value="">Đã đăng ký</option>
                        <option value="">Đã điểm danh</option>
                        <option value="">Đã tiêm</option>
                        <option value="">Đã hủy</option>
                    </select>

                    <label for="vaccine">Vaccine</label>
                    <select type="text" name="vaccine">

                        <option value=""></option>
                        <option value="">AstraZeneca</option>
                        <option value="">Comirnaty</option>
                        <option value="">Verro Cell</option>
                    </select>

                    <label for="time">Buổi</label>
                    <select type="drop-down" name="time">
                        <option value=""></option>
                        <option value="">Sáng</option>
                        <option value="">Chiều</option>
                        <option value="">Tối</option>
                    </select>

                    <button class="btn-filter">
                        <img src="image/filter-magnifier.png" alt="filter-magnifier">
                        Tìm kiếm
                    </button>
                </div>
            </div>

            <br>

            <div class="panel-list-registration">
                <div class="list-name">DANH CÁC LƯỢT ĐĂNG KÝ TIÊM CHỦNG</div>

                <br>
                <div class="holder">
                    <div class="list-registration" id="list-registration">
                        <div class="registration">
                            <p class="obj-org-name">Bệnh viện Đa khoa huyện Dầu Tiếng</p>
                            <div class="holder-obj-attr">
                                <div class="obj-attr">
                                    <p class="attr-address">Đ/c: Bình Dương, Dầu Tiếng, Dầu Tiếng, Hùng Vương</p>
                                    <p class="attr-date-time-no">Lịch tiêm ngày: 24/11/2022 Buổi Sáng STT: 1</p>
                                    <p class="attr-vaccine-serial">Vaccine: AstraZeneca - Chrysanthemum Tình trạng: Đã tiêm</p>
                                </div>

                                <div class="interactive-area">
                                    <button class="btn-cancel-registration">Hủy lịch</button>
                                </div>
                            </div>
                        </div>

                        <div class="registration">
                            <p class="obj-org-name">Bệnh viện Đa khoa huyện Dầu Tiếng</p>
                            <div class="holder-obj-attr">
                                <div class="obj-attr">
                                    <p class="attr-address">Đ/c: Bình Dương, Dầu Tiếng, Dầu Tiếng, Hùng Vương</p>
                                    <p class="attr-date-time-no">Lịch tiêm ngày: 24/11/2022 Buổi Sáng STT: 1</p>
                                    <p class="attr-vaccine-serial">Vaccine: AstraZeneca - Chrysanthemum Tình trạng: Đã tiêm</p>
                                </div>

                                <div class="interactive-area">
                                    <button class="btn-cancel-registration">Hủy lịch</button>
                                </div>
                            </div>
                        </div>

                        <div class="registration">
                            <p class="obj-org-name">Bệnh viện Đa khoa huyện Dầu Tiếng</p>
                            <div class="holder-obj-attr">
                                <div class="obj-attr">
                                    <p class="attr-address">Đ/c: Bình Dương, Dầu Tiếng, Dầu Tiếng, Hùng Vương</p>
                                    <p class="attr-date-time-no">Lịch tiêm ngày: 24/11/2022 Buổi Sáng STT: 1</p>
                                    <p class="attr-vaccine-serial">Vaccine: AstraZeneca - Chrysanthemum Tình trạng: Đã tiêm</p>
                                </div>

                                <div class="interactive-area">
                                    <button class="btn-cancel-registration">Hủy lịch</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>

    <br>

    <footer class="footer">
        <!-- <div class="footer-alignment-side"></div> -->
        <div class="footer-content">&copy; Bản quyền thuộc TRUNG TÂM CÔNG NGHỆ PHÒNG, CHỐNG DỊCH COVID-19 QUỐC GIA</div>
        <div class="footer-content">Phát triển bởi Chrysanthemums</div>
        <div class="footer-logo"><img src="image/Logo BỘ.png" alt="Logo Bộ Y Tế "></div>
        <!-- <div class="footer-alignment-side"></div> -->
    </footer>
</body>

</html>