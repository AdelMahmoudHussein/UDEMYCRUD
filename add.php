<?php
    include "db.php";

    if (isset($_POST['send'])) {
        $task = $_POST['task-name'];
        $query = "INSERT INTO tasks2 (name) VALUES ('$task')"; // name without "", values with '' single it is MUST
        $inserted = $conn->query($query);
        if ($inserted) {
            // go to index.php
            header('location:index.php');
        }
    } else {
        echo "No Task Added";
    }
