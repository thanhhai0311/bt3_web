<?php

session_start();
$id = $_GET['id'];
require_once ('connect_db.php');

$query = "DELETE from lop_tbl WHERE id_lop = $id";

$result = $con->query($query);

header("Location: class.php");
exit();

?>