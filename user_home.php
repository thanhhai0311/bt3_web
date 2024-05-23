<?php

session_start();
require_once ('connect_db.php');
if (isset($_SESSION['username']) && isset($_SESSION['user_type']) && $_SESSION['logged_in']) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="main.css">
        <title>Home Page</title>
    </head>

    <body>
        <!-- Side Bar -->
        <div class="side_bar">
            <div class="container-fluid">
                <div class="row flex-nowrap">
                    <?php echo file_get_contents("user_baseUI.html"); ?>

                    <div class="col py-3 main">
                        <h1>Trang chủ</h1>

                        <hr style="border: 2px solid blue">
                        <br><br>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <div class="card" style="background-color: #0a0a0a; color: #fff">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h2>Tiền dịch vụ</h2>
                                                    </div>
                                                    <div class="col" style="max-width: fit-content !important;">
                                                        <i class="fs-4 bi bi-cash-coin"></i>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <a href="user_fee.php" class="text-white text-decoration-none"
                                                    style="min-width: 100%; text-align: center;">
                                                    Xem Thêm
                                                    <i class="bi bi-arrow-right-circle-fill mx-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3">
                                        <div class="card" style="background-color: #0a0a0a; color: #fff">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h2>Nghỉ Phép</h2>
                                                    </div>
                                                    <div class="col" style="max-width: fit-content !important;">
                                                        <i class="fs-4 bi bi-person-x"></i>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <a href="user_leave.php" class="text-white text-decoration-none"
                                                    style="min-width: 100%; text-align: center;">
                                                    Xem Thêm
                                                    <i class="bi bi-arrow-right-circle-fill mx-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: login.php");
    exit();
}
?>