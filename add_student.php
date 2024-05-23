<?php

    session_start();
    require('connect_db.php');

    $nameErr = $emailErr = $genderErr = $addressErr = $phoneErr=$avatarErr=$joinErr=$birthErr= "";
    $name = $email = $gender = $birth = $address = $phone = $class = $join = $avatar = "";

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Chưa nhập tên";
        } else {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Chưa nhập emal";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Sai định dạng email";
            }
        }

        if (empty($_POST["address"])) {
            $address = "";
            $addressErr = "Chưa nhập địa chỉ";
        } else {
            $address = test_input($_POST["address"]);
        }

        if (empty($_POST["birth"])) {
            $birthErr = "Chưa chọn ngày sinh";
        } else {
            $birth = test_input($_POST["birth"]);
        }

        if (empty($_POST["gender"])) {
            $genderErr = "Chưa chọn giới tính";
        } else {
            $gender = $_POST["gender"];
        }

        if (empty($_POST["phone"])) {
            $phoneErr = "Chưa nhập số điện thoại";
        } else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/^[0-9' ]*$/",$phone)) {
                $phoneErr = "Chỉ bao gồm chữ số";
            }
        }

        if (empty($_POST["select_class"])) {
            $class = "";
        } else {
            $class = test_input($_POST["select_class"]);
        }

        if (empty($_POST["join"])) {
            $joinErr = "Vui lòng chọn ngày vào học";
        } else {
            $join = test_input($_POST["join"]);
        }

        if (empty($_POST["avatar"])) {
            $avatarArr = "default_avatar.svg";
        } else {
            $avatar = test_input($_POST["avatar"]);
        }
    }

    function checkErr($nameErr, $emailErr, $genderErr, $addressErr, $phoneErr) {
        if (!empty($nameErr) || !empty($emailErr) || !empty($genderErr) || !empty($addressErr) || !empty($phoneErr)) {
            return false;
        }
        return true;
    }

    if (isset($_POST['submit'])) {
        if (!empty($name) && !empty($email)  && !empty($avatar) && !empty($birth) && !empty($gender) && !empty($address) && !empty($phone) && !empty($class) && !empty($join) && checkErr($nameErr, $emailErr, $genderErr, $addressErr, $phoneErr)) {
            $query2 = "INSERT INTO sinh_vien_tbl(id_sv, ten, ngay_sinh, gioi_tinh, so_dien_thoai, email, dia_chi, id_lop, ngay_vao_hoc, ngay_them, anh, ngay_cap_nhat)
            VALUES (NULL,'$name','$birth','$gender','$phone','$email','$address','$class','$join',NULL,'$avatar', '$join');";

            $con->query($query2);

            header("Location: student.php");
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
                            <h1>Sinh Viên</h1>

                            <hr style="border: 2px solid blue">
                            <br><br>

                            <div class="card card-registration">

                                <div class="card-body">

                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Đăng ký sinh viên mới</h3>
                                    <form method="post">

                                        <div class="row">
                                            <div class="col-md-6 mb-4">

                                                <div class="form-outline">
                                                    <label class="form-label" for="firstName">Họ và tên</label> <span class="error text-danger"> * <?php echo $nameErr;?></span>
                                                    <input type="text" name="name" class="form-control form-control-lg" />
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4">

                                                <div class="form-outline">
                                                    <label class="form-label" for="lastName">Email</label> <span class="error text-danger"> * <?php echo $emailErr;?></span>
                                                    <input type="text" name="email" class="form-control form-control-lg" />

                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4 d-flex align-items-center">

                                                <div class="form-outline datepicker w-100">
                                                    <label for="birthdayDate" class="form-label">Ngày sinh</label> <span class="error text-danger"> * <?php echo $birthErr  ?></span>
                                                    <input type="date" class="form-control form-control-lg" name="birth" />

                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4">

                                                <p class="mb-2 pb-1">Giới tính: </p> <span class="error text-danger"> * </span>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender" id="maleGender"
                                                    value="Nam" checked />
                                                    <label class="form-check-label" for="maleGender">Nam</label>
                                                </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                                                value="Nữ" />
                                                <label class="form-check-label" for="femaleGender">Nữ</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="otherGender"
                                                value="Khác" />
                                                <label class="form-check-label" for="otherGender">Khác</label>
                                            </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <label class="form-label" for="emailAddress">Địa chỉ</label> <span class="error text-danger"> * <?php echo $addressErr;?></span>
                                                    <input type="text" name="address" class="form-control form-control-lg" />

                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <label class="form-label" for="phoneNumber">Số điện thoại</label> <span class="error text-danger"> * <?php echo $phoneErr;?></span>
                                                    <input type="tel" name="phone" class="form-control form-control-lg" />
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-4 pb-2">
                                                <label class="form-label select-label">Lớp</label> <span class="error text-danger"> * </span>
                                                <select class="form-select form-control-lg" name="select_class">

                                                    <?php

                                                        $query1 = "SELECT * FROM lop_tbl";

                                                        $class_arr = $con->query($query1);

                                                        while($row = $class_arr->fetch_assoc()) {
                                                            ?>
                                                            <option value=<?php echo $row['id_lop']; ?> ?><?php echo $row['ten_lop']?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>

                                            </div>

                                            <div class="col-md-4 mb-4 pb-2">
                                            <label for="birthdayDate" class="form-label">Ngày vào học</label> <span class="error text-danger"> * <?php echo $joinErr?> </span>
                                                    <input type="date" class="form-control form-control-lg" name='join' />

                                            </div>


                                            <div class="col-md-4 mb-4 pb-2">
                                                <label class="form-label" for="customFile">Avatar</label> <span class="error text-danger"> * </span>
                                                <input type="file" class="form-control" name="avatar" />

                                            </div>
                                        </div>

                                        <div class="mt-4 pt-2">
                                            <input class="btn btn-success btn-lg float-end" type="submit" name="submit" value="Thêm mới" />
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
    }
    else {
        header("Location: error.html");
        exit();
    }
?>