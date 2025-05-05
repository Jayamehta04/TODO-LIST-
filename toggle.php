<?php
include "config.php";

$id = $_POST['id'];
$completed = isset($_POST['completed']) ? 1 : 0;

mysqli_query($con, "UPDATE tbltodo SET completed=$completed WHERE Id=$id");
header("Location: index.php");
?>
