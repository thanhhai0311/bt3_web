<?php

session_start();
require ('connect_db.php');

$reasonErr = $detailErr = $startDateErr = $endDateErr = "";
$reason = $detail = $startDate = $endDate = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["reason"])) {
        $reasonErr = "Vui lòng nhập lí do";
    } else {
        $reason = test_input($_POST["reason"]);
    }
    if (empty($_POST["detail"])) {
        $detailErr = "Vui lòng nhập";
    } else {
        $detail = test_input($_POST["detail"]);
    }
    if (empty($_POST["startDate"])) {
        $startDateErr = "Vui lòng chọn ngày bắt đầu nghỉ";
    } else {
        $startDate = test_input($_POST["startDate"]);
    }
    if (empty($_POST["endDate"])) {
        $endDateErr = "Vui lòng chọn ngày bắt đầu đi học";
    } else {
        $endDate = test_input($_POST["endDate"]);
    }

}

if (isset($_POST['submit'])) {
    if (!empty($reason) && !empty($detail) && !empty($startDate) && !empty($endDate)) {
        $id = $_GET['id'];
        $query2 = "INSERT INTO nghi_phep(id_sinhvien, ly_do, chi_tiet, ngay_bat_dau, ngay_ket_thuc, ngay_tao_don, trang_thai)
        VALUES ($id,'$reason','$detail','$startDate','$endDate',NULL,0);";

        $con->query($query2);

        header("Location: user_leave.php");
        exit();
    }
}


if (isset($_SESSION['username']) && isset($_SESSION['user_type']) && $_SESSION['logged_in']) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.datatables.net/v/bs5/dt-2.0.5/datatables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="main.css">
        <title>Home Page</title>
    </head>

    <body>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="\Datatables\datatables.js"></script>
        <script src="\Datatables\datatables.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>

        <!-- Side Bar -->
        <div class="side_bar">

            <div class="container-fluid">
                <div class="row flex-nowrap">
                    <?php echo file_get_contents("user_baseUI.html"); ?>

                    <div class="col py-3">
                        <h1>Sinh Viên</h1>

                        <hr style="border: 2px solid blue">
                        <br><br>

                        <div class="card card-registration">

                            <div class="card-body">

                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Đăng kí lịch nghỉ</h3>
                                <form method="post">
                                    <div class="col-md-8 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Lý do</label> <span
                                                class="error text-danger"> * <?php echo $reasonErr; ?></span>
                                            <input type="text" name="reason" class="form-control form-control-lg" />
                                        </div>

                                    </div>
                                    <div class="col-md-8 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Chi tiết</label> <span
                                                class="error text-danger"> * <?php echo $detailErr; ?></span>
                                            <input type="text" name="detail" class="form-control form-control-lg" />

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-4 pb-2">
                                            <label for="birthdayDate" class="form-label">Ngày bắt đầu</label> <span
                                                class="error text-danger"> * <?php echo $startDateErr ?> </span>
                                            <input type="date" class="form-control form-control-lg" name='startDate' />

                                        </div>
                                        <div class="col-md-4 mb-4 pb-2">
                                            <label for="birthdayDate" class="form-label">Ngày kết thúc</label> <span
                                                class="error text-danger"> * <?php echo $endDateErr ?> </span>
                                            <input type="date" class="form-control form-control-lg" name='endDate' />

                                        </div>
                                    </div>

                                    <div class="col-md-1 mb-4">
                                        <input class="btn btn-success btn-lg float-end" type="submit" name="submit"
                                            value="Thêm mới" />
                                    </div>

                                </form>
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
    header("Location: error.html");
    exit();
}
?>