<!DOCTYPE html>
<html>
<head>
    <title>TODO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/86c2bd3805.js" crossorigin="anonymous"></script>

    <style>
        body.bg-flash {
            background-color: #28a745 !important; /* green flash */
            transition: background-color 1s ease;
        }
        .task-text {
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .completed {
            color: green;
            text-decoration: line-through;
        }
        .incomplete {
            color: black;
        }
    </style>

    <script>
        function toggleTaskStyle(checkbox) {
            const span = checkbox.nextElementSibling;
            if (checkbox.checked) {
                span.classList.remove("incomplete");
                span.classList.add("completed");
            } else {
                span.classList.remove("completed");
                span.classList.add("incomplete");
            }
        }

        // Flash background color when new task is added
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('added') === '1') {
                document.body.classList.add('bg-flash');
                setTimeout(() => {
                    document.body.classList.remove('bg-flash');
                }, 1000);
                // Remove the query parameter from URL without reloading
                history.replaceState(null, '', window.location.pathname);
            }
        }
    </script>
</head>

<body class="bg-primary">
    <form action="insert.php" method="POST">
        <div class="container">
            <div class="row justify-content-center m-auto shadow bg-white mt-3 py-3 col-md-6">
                <h3 class="text-center text-primary font-monospace">TODO LIST</h3>
                <div class="col-8">
                    <input type="text" name="list" class="form-control" placeholder="Enter task" required>
                </div>
                <div class="col-2">
                    <button class="btn btn-outline-primary"><i class="fa-solid fa-square-plus"></i></button>
                </div>
            </div>
        </div>
    </form>

    <?php
    include "config.php";
    $rawData = mysqli_query($con, "SELECT * FROM tbltodo");
    ?>

    <div class="container">
        <div class="col-8 bg-white m-auto mt-3">
            <table class="table">
                <tbody>
                    <?php while ($row = mysqli_fetch_array($rawData)) { ?>
                    <tr>
                        <td>
                            <form action="toggle.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
                                <input type="checkbox" name="completed"
                                    onchange="toggleTaskStyle(this); this.form.submit()"
                                    <?php if ($row['completed']) echo 'checked'; ?>>
                                <span class="task-text <?php echo $row['completed'] ? 'completed' : 'incomplete'; ?>">
                                    <?php echo $row['list']; ?>
                                </span>
                            </form>
                        </td>
                        <td style="width:10%;">
                            <a href="delete.php?ID=<?php echo $row['Id']; ?>" class="btn btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                        <td style="width:10%;">
                            <a href="update.php?ID=<?php echo $row['Id']; ?>" class="btn btn-outline-success">update</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
