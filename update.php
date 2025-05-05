<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<?php
$id = $_GET['ID'];
include "config.php";
$Rdata = mysqli_query($con, "SELECT * FROM tbltodo WHERE Id=$id");
$data = mysqli_fetch_array($Rdata);
?>

<body class="bg-info">
<form action="update1.php" method="POST">
    <div class="container">
        <div class="row justify-content-center m-auto shadow bg-white mt-3 py-3 col-md-6">
            <h3 class="text-center text-primary font-monospace">Update</h3>
            <div class="col-8">
                <input type="text" value="<?php echo $data['list']; ?>" name="list" class="form-control" placeholder="Enter task">
            </div>
            <div class="col-2">
                <button class="btn btn-outline-primary">Update</button>
                <input type="hidden" name="id" value="<?php echo $data['Id']; ?>">
            </div>
        </div>
    </div>
</form>
</body>
</html>
