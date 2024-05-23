<?php

session_start();

require_once ('connect_db.php');

$id_sv = $date = "";
$tong = $da_dong = $con_lai = 0;
$idErr = $cbErr = $pcErr = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["id_sv"])) {
        $idErr = "Chưa nhập ID sinh viên";
    } else {
        $id_sv = test_input($_POST["id_sv"]);
        if (!preg_match("/^[0-9' ]*$/", $id_sv)) {
            $idErr = "Chỉ bao gồm chữ số";
        }
    }

    if (empty($_POST["date"])) {
        $date = "";
    } else {
        $date = test_input($_POST["date"]);
    }

    if (empty($_POST["tong"])) {
        $cbErr = "Chưa nhập tổng chi phí dịch vụ";
    } else {
        $tong = test_input($_POST["tong"]);
        if (!preg_match("/^[0-9' ]*$/", $tong)) {
            $cbErr = "Chỉ bao gồm chữ số";
        }
    }

    if (empty($_POST["da_dong"])) {
        $pcErr = "Chưa nhập số tiền đã đóng";
    } else {
        $da_dong= test_input($_POST["da_dong"]);
        if (!preg_match("/^[0-9' ]*$/", $da_dong)) {
            $pcErr = "Chỉ bao gồm chữ số";
        }
    }

    $con_lai = $tong - $da_dong;
}

function checkErr($idErr, $cbErr, $pcErr)
{
    if (!empty($idErr) || !empty($cbErr) || !empty($pcErr)) {
        return false;
    }
    return true;
}

if (isset($_POST['submit'])) {
    if (!empty($id_sv) && !empty($date) && !empty($tong) && !empty($da_dong) && checkErr($idErr, $cbErr, $pcErr)) {
        $query = "INSERT INTO tien_dich_vu_tbl(id_tien, id_sinhvien, tong, da_dong, con_lai, ngay_them, ngay_cap_nhat) 
            VALUES (NULL,'$id_sv','$tong','$da_dong','$con_lai',NULL,'$date')";

        $con->query($query);

        header("Location: fee.php");
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
                    <?php echo file_get_contents("baseUI.html"); ?>

                    <div class="col py-3">
                        <h1>Tiền dịch vụ</h1>

                        <hr style="border: 2px solid blue">
                        <br><br>

                        <div class="card card-registration">

                            <div class="card-body">

                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Thêm tiền dịch vụ mới</h3>
                                <form method="post">

                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="firstName">ID Sinh Viên</label> <span
                                                    class="error text-danger"> * <?php echo $idErr; ?></span>
                                                <input type="text" name="id_sv" class="form-control form-control-lg" />
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4 d-flex align-items-center">

                                            <div class="form-outline datepicker w-100">
                                                <label for="birthdayDate" class="form-label">Ngày Cập Nhật</label> <span
                                                    class="error text-danger"> * </span>
                                                <input type="date" class="form-control form-control-lg" name="date" />

                                            </div>

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4 mb-4 pb-2">

                                            <div class="form-outline">
                                                <label class="form-label" for="emailAddress">Tổng</label> <span
                                                    class="error text-danger"> * <?php echo $cbErr; ?></span>
                                                <input type="text" name="tong" id="tong"
                                                    class="form-control form-control-lg"
                                                    oninput="updateFee(this.value)" />

                                            </div>

                                        </div>
                                        <div class="col-md-4 mb-4 pb-2">

                                            <div class="form-outline">
                                                <label class="form-label" for="phoneNumber">Đã Đóng</label> <span
                                                    class="error text-danger"> * <?php echo $pcErr; ?></span>
                                                <input type="tel" name="da_dong" id="da_dong"
                                                    class="form-control form-control-lg"
                                                    oninput="updateFee(this.value )" />
                                            </div>

                                        </div>

                                        <div class="col-md-4 mb-4 pb-2">

                                            <div class="form-outline">
                                                <label class="form-label" for="phoneNumber">Còn lại</label> <span
                                                    class="error text-danger"> * </span>
                                                <input type="tel" name="con_lai" class="form-control form-control-lg"
                                                    id="con_lai" />
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mt-4 pt-2">
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



        <script>
            function updateFee(val) {
                console.log(val);
                let t = document.getElementById('tong').value === '' ? 0 : document.getElementById('tong').value;
                let dd = document.getElementById('da_dong').value === '' ? 0 : document.getElementById('da_dong').value;
                document.getElementById('con_lai').value = parseInt(t) - parseInt(dd);
            }

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: error.html");
    exit();
}
?>