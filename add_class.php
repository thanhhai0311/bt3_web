<?php

session_start();
$error = "";

if (isset($_POST['submit'])) {
    if (empty($_POST['class_name'])) {
        $error = "Vui lòng không để trống!";
    } else {
        $class_name = $_POST['class_name'];

        require_once ('connect_db.php');

        $query = "INSERT INTO lop_tbl(id_lop, ten_lop, ngay_them) VALUES (NULL,'$class_name',NULL);";

        $con->query($query);

        header("Location: class.php");
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
        <link rel="stylesheet" href="main.css">
        <title>Home Page</title>
    </head>

    <body>
        <!-- Side Bar -->
        <div class="side_bar fixed-top">
            <div class="container-fluid">
                <div class="row flex-nowrap">
                    <?php echo file_get_contents("baseUI.html"); ?>
                    <div class="col py-3 main">
                        <h1>Thêm Lớp</h1>

                        <hr style="border: 2px solid blue">
                        <br><br>

                        <div class="card">
                            <div class="card-body">
                                <form method="post">
                                    <label class="form-label">Tên lớp</label>
                                    <input class="form-control form-control-lg" type="text" name="class_name"
                                        placeholder="Tên lớp">
                                    <span class="error">* <?php echo $error ?></span>
                                    <br>
                                    <input type="submit" name="submit" class="btn btn-lg btn-success float-end"
                                        value="Thêm mới"></input>
                                </form>
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