<?php

session_start();
$id = $_POST['id'];
require_once ('connect_db.php');

$query = "UPDATE nghi_phep SET trang_thai = 1 WHERE id = $id";

$result = $con->query($query);

header("Location: leave.php");
exit();

?>
