<!DOCTYPE html>

<?php

    //ini_set("display_errors", 1);
    // Fwo Ways to include
    //include("./db.php");
    include "db.php";


    if (isset($_GET['search'])) {
        $search = htmlspecialchars($_GET['search']);
        // ------------------------------------------------------------------ //
        // Pagination
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        // must check for valid number as if some one put string atfer page it will converted to 0
        // so this ($page * $perPage) - $perPage -----> will give -5 so error
        $page = ($page>1) ? $page : 1;

        $perPage = (isset($_GET['perpage'])) ? (int)$_GET['perpage'] : 5;
        // to overcome string instead of number in perpape it will be 0 so devide by zero will be INF
        // Also to overcome minus numbers
        $perPage = ($perPage>0)? $perPage : 5;
        //SELECT * FROM `tasks` WHERE `name` LIKE '%as%' ====> Single qoutation is MUST
        // '%{$search}%'  OR '%$search%'  NOT %{$search}%
        $total = $conn->query("SELECT * FROM tasks WHERE name LIKE '%{$search}%' ")->num_rows;
        $pages = ceil($total/$perPage);


        $start = ($page * $perPage) - $perPage;

        //echo "$page,$perPage,$total,$pages,$start";

        // get only the needed rows
        $query = "SELECT * FROM tasks WHERE name LIKE '%{$search}%' LIMIT {$start} , {$perPage}";
        $rows = $conn->query($query);

        // ------------------------------------------------------------------ //
    }

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

            <div> <!--col-md-offset-1  class="col-md-12"-->
                <div style="margin-top:50px;">
                    <center><h1><a href="index.php">Todo List</a></h1><br/></center>
                    <button type="button" data-target="#myModal" data-toggle="modal" name="add-task" class="btn btn-success">Add Task</button>
                    <button type="button" name="print" class="btn btn-default float-right" onclick="print()">Print</button>
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
                <div class="text-center">
                    <h3>Search</h3>
                    <form class="form-group" action="search.php" method="GET">
                        <input type="text" name="search" class="form-control"
                        placeholder="Type Here To Search Tasks" name="search">
                    </form>
                </div>
                <!-- Start Results Logic -->
                <?php if (mysqli_num_rows($rows) < 1): ?>
                    <h2 class="text-danger text-center">No Results Found</h2>
                    <a href="index.php" class="btn btn-warning">Back</a>
                <?php else: ?>
                    <h3 class="text-success">Results</h3>
                    <!-- The Table -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" class="col-md-6">Task</th>
                                <th scope="col"><label>Per Page</label></th>
                                <th scope="col">
                                    <form class="form-group" action="" method="GET">
                                        <input type="hidden" name="search" value="<?php echo $search ?>">
                                        <input type="number" name="perpage" class="form-control" max="25" min="5" step="5">
                                    </form>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $rows->fetch_assoc()):?>
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-success">Edit</a></td>
                                    <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <!-- End The Table -->
                    <!-- Start Pagination -->
                    <ul class="pagination justify-content-center" >
                        <?php for ($i=1; $i <= $pages; $i++): ?>
                            <!-- Active State The .active class is used to "highlight" the current page:  -->
                            <li class="page-item <?php echo ($page === $i) ? "active":"" ?>"><a class="page-link" href="search.php?page=<?php echo $i;?>&perpage=<?php echo $perPage;?>&search=<?php echo $search;?>"><?php echo $i;?></a></li>
                        <?php endfor;?>
                    </ul>
                    <!-- End Pagination -->
                <?php endif; ?>

            </div>

        </div>
    </body>
</html>
