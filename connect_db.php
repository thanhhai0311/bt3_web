<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "db_hai");
define("PORT", "3308");


// $host = 'localhost';
// $username = 'root';
// $password = ''; // Nếu bạn không có mật khẩu, hãy để trống chuỗi
// $database = 'bt3';

$con = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);

if (!$con)
    echo "fail";
else

?>