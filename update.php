<?php

    ini_set("display_errors", 1);
    // Fwo Ways to include
    //include("./db.php");
    include "db.php";

    // For POST method after updating
    if (isset($_POST['send'])) {
        $id = $_POST['id'];
        $task = $_POST['task-name'];
        $query2 = "UPDATE tasks2 SET name = '$task' WHERE id = '$id'";
        $updated = $conn->query($query2);
        if ($updated) {
            // go to index.php
            header('location:index.php');
        }
    }
