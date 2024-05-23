<?php

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_type']) && $_SESSION['logged_in']) {

    if (isset($_GET['search'])) {
        // Lấy cột muốn sắp xếp và hướng sắp xếp từ yêu cầu
        $search = $_GET['search'];
        require_once ('connect_db.php');
        $query = "SELECT * FROM sinh_vien_tbl inner join lop_tbl on sinh_vien_tbl.id_lop=lop_tbl.id_lop WHERE ten LIKE '%$search%'";
        $student_result = $con->query($query);
    } else {
        // Truy vấn cơ sở dữ liệu mặc định
        require_once ('connect_db.php');
        $query = "SELECT * FROM sinh_vien_tbl inner join lop_tbl on sinh_vien_tbl.id_lop=lop_tbl.id_lop";
        $student_result = $con->query($query);
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
                        <br>

                        <div class="card">
                            <div class="card-body">
                                <form class="mb-5" method="GET">
                                    <div class="row justify-content-center align-items-center g-2">
                                        <div class="col">
                                            <input type="text" name="search" class="form-control"
                                                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                                                placeholder="Tìm kiếm theo tên">
                                        </div>
                                        <div class="col"> <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </form>
                                <table id="student_table" class="table table-striped table-hover">
                                    <thead style="position: sticky; top: 0; ">
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Avatar</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Ngày Sinh</th>
                                            <th scope="col">Giới Tính</th>
                                            <th scope="col">Số Điện Thoại</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Địa Chỉ</th>
                                            <th scope="col">Lớp</th>
                                            <th scope="col">Ngày Vào Học</th>
                                            <th scope="col">Thao Tác</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        // require_once ('connect_db.php');
                                    
                                        // $query = "SELECT * FROM nhan_vien_tbl inner join chuc_vu_tbl on nhan_vien_tbl.id_chuc_vu=chuc_vu_tbl.id_cv";
                                        // $staff_result = $con->query($query);
                                    
                                        while ($row = $student_result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['id_sv']; ?></th>
                                                <td><img src="<?php echo $row['anh']; ?>" alt="default avatar" height="50px"
                                                        width="50px"></td>
                                                <td><?php echo $row['ten']; ?></td>
                                                <td><?php echo $row['ngay_sinh']; ?></td>
                                                <td><?php echo $row['gioi_tinh']; ?></td>
                                                <td><?php echo $row['so_dien_thoai']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['dia_chi']; ?></td>
                                                <td><?php echo $row['ten_lop']; ?></td>
                                                <td><?php echo $row['ngay_vao_hoc']; ?></td>
                                                <td>
                                                    <a href="edit_student.php?id=<?php echo $row['id_sv']; ?>"
                                                        class="btn btn-success px-4 ">Sửa</a>
                                                    <a onclick="return confirm('Bạn có chắc muốn xoá sinh viên này không?');"
                                                        href="delete_student.php?id=<?php echo $row['id_sv']; ?>"
                                                        class="btn btn-danger px-4">Xoá</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>

                                    <script>
                                        $(document).ready(function () {
                                            new DataTable('#student_table', {
                                                language: {
                                                    info: 'Trang _PAGE_/_PAGES_',
                                                    infoEmpty: 'Không có dữ liệu',
                                                    infoFiltered: '(Lọc từ _MAX_ item)',
                                                    lengthMenu: 'Hiển thị _MENU_ item / trang',
                                                    zeroRecords: 'Không có item tương ứng',
                                                    search: 'Tìm kiếm'
                                                }
                                            });
                                        });
                                    </script>

                                </table>
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