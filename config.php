<?php
$con = mysqli_connect("localhost", "todo_user", "123456", "todo",3307);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
