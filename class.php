<?php

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_type']) && $_SESSION['logged_in']) {
    if (isset($_GET['search'])) {
        // Lấy từ khóa tìm kiếm
        $search = $_GET['search'];

        // Truy vấn cơ sở dữ liệu với điều kiện tìm kiếm
        require_once ('connect_db.php');
        $query = "SELECT * FROM lop_tbl WHERE ten_lop LIKE '%$search%'";
        $result = $con->query($query);
    } else {
        // Truy vấn cơ sở dữ liệu mặc định nếu không có từ khóa tìm kiếm
        require_once ('connect_db.php');
        $query = "SELECT * FROM lop_tbl";
        $result = $con->query($query);

    }
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="\Datatables\datatables.js"></script>
        <script src="\Datatables\datatables.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>

        <!-- Side Bar -->
        <div class="side_bar">
            <div class="container-fluid">
                <div class="row flex-nowrap">
                    <?php echo file_get_contents("baseUI.html"); ?>

                    <div class="col py-3">
                        <h1>Lớp</h1>

                        <hr style="border: 2px solid blue">
                        <br>
                        <!-- Thêm ô nhập văn bản cho tìm kiếm -->
                        <div class="card">
                            <div class="card-body">
                                <form class="mb-5" method="GET">
                                    <div class="row justify-content-center align-items-center g-2">
                                        <div class="col">
                                            <input type="text" name="search" class="form-control"
                                                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                                                placeholder="Tìm kiếm theo lớp">
                                        </div>
                                        <div class="col"> <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </form>
                                <table id="class_table" class="table table-striped table-hover">
                                    <thead style="position: sticky; top: 0; ">
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Lớp</th>
                                            <th scope="col">Ngày Thêm</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            if ($row['id_lop'] == 0) {
                                                continue;
                                            }
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['id_lop']; ?></th>
                                                <td><?php echo $row['ten_lop']; ?></td>
                                                <td><?php echo $row['ngay_them']; ?></td>
                                                <td>
                                                    <a href="edit_class.php?id=<?php echo $row['id_lop']; ?>"
                                                        class="btn btn-success px-4">Sửa</a>
                                                    <a onclick="return confirm('Bạn có chắc muốn xoá lớp này không?');"
                                                        href="delete_class.php?id=<?php echo $row['id_lop']; ?>"
                                                        class="btn btn-danger px-4">Xóa</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </body>

    </html>
    <?php
} else {
    header("Location: error.html");
    exit();
}
?>