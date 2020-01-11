<?php
    ini_set("display_errors", 1);
    include "db.php";

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $query = "DELETE FROM tasks WHERE id = '$id'";
        $deleted = $conn->query($query);
        if ($deleted) {
            // go to index.php
            header('location:index.php');
        }
    }
