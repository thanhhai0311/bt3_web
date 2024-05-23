<?php

session_start();
$id = $_GET['id'];
require_once ('connect_db.php');

$query = "DELETE from sinh_vien_tbl WHERE id_sv = $id";

$result = $con->query($query);

header("Location: student.php");
exit();

?>