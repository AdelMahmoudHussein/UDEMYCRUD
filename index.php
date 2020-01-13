<!DOCTYPE html>

<?php

    ini_set("display_errors", 1);
    // Fwo Ways to include
    //include("./db.php");
    include "db.php";
    $query = "SELECT * FROM tasks2";
    $rows = $conn->query($query);


    /*
    <?php foreach ($rows as $row):?>
        <tr>
            <th scope="row"><?php echo $row['id']; ?></th>
            <td><?php echo $row['name']; ?></td>
            <td><a href="#" class="btn btn-success">Edit</a></td>
            <td><a href="#" class="btn btn-danger">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    */
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

            <div class="col-md-10 col-md-offset-1"> <!--col-md-offset-1 -->
                <div style="margin-top:90px;">
                    <center><h1>Todo List</h1><br/></center>
                    <button type="button" data-target="#myModal" data-toggle="modal" name="add-task" class="btn btn-success">Add Task</button>
                    <button type="button" name="print" class="btn btn-default float-right" >Print</button>
                    <hr><br>
                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Task</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form class="" method="POST" action="add.php">
                                        <div class="form-group">
                                            <label for="task-name">Task Name: </label>
                                            <input type="text" name="task-name" id="task-name" class="form-control" required>
                                        </div>
                                        <input type="submit" name="send" value="ADD" class="btn btn-success">

                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End The Modal -->

                </div>
                <!-- The Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" class="col-md-6">Task</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $rows->fetch_assoc()):?>
                            <!-- The Modal 2 -->
                            <div id="message<?php echo $row['id'];?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update Task</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form class="" method="POST" action="update.php">
                                                <div class="form-group">
                                                    <label >Task Name: </label>
                                                    <input type="text" name="task-name" class="form-control" required
                                                    value="<?php echo $row['name']; ?>">
                                                    <!-- This is hidden input to save id  -->
                                                    <input type="text" name="id" value="<?php echo $row['id']; ?>" hidden>
                                                </div>
                                                <input type="submit" name="send" value="Update" class="btn btn-success">

                                            </form>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End The Modal -->
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['name']; ?></td>

                                <td><button type="button" data-target="#message<?php echo $row['id'];?>" data-toggle="modal" name="update-task" class="btn btn-success" >Edit</button></td>
                                <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <!-- End The Table -->
            </div>
        </div>
    </body>
</html>
