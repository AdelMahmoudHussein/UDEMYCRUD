<!DOCTYPE html>

<?php

    ini_set("display_errors", 1);
    // Fwo Ways to include
    //include("./db.php");
    include "db.php";
    // For GET method when first order for updating
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $page = (int)$_GET['page'];
        $perPage = (int)$_GET['perpage'];
        $query = "SELECT * FROM tasks WHERE id = '$id'";
        $rows = $conn->query($query);
        $row = $rows->fetch_assoc();
    }

    // For POST method after updating
    if (isset($_POST['send'])) {
        $id = (int)$_POST['id'];
        $page = (int)$_POST['page'];
        $perPage = (int)$_POST['perpage'];
        $task = htmlspecialchars($_POST['task-name']);
        $query2 = "UPDATE tasks SET name = '$task' WHERE id = '$id'";
        $updated = $conn->query($query2);
        if ($updated) {
            // go to index.php
            $home = "index.php?page={$page}&perpage={$perPage}";
            header("location:$home");
        }
    }
?>

<html lang="en" dir="ltr">
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src=""></script>
        <meta charset="utf-8">
        <title>CRUD APP</title>
    </head>
    <body>
        <div class="container">
            <center><h1>Update Task</h1><br/></center>
            <form class="" method="POST" action="update.php">
                <div class="form-group">
                    <label for="task-name">Task Name: </label>
                    <input type="text" name="task-name" id="task-name" class="form-control" required
                    value="<?php echo $row['name']; ?>">
                    <!-- This is hidden input to save id  -->
                    <input type="text" name="id" value="<?php echo $row['id']; ?>" hidden>
                    <input type="text" name="page" value="<?php echo $page ?>" hidden>
                    <input type="text" name="perpage" value="<?php echo $perPage;?>" hidden>
                </div>

                <input type="submit" name="send" value="Update" class="btn btn-success">
                <a class="btn btn-warning" href="index.php?page=<?php echo $page ?>&perpage=<?php echo $perPage;?>">Cancel</a>
            </form>
        </div>
    </body>
</html>
