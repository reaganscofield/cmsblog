<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>CMS App | By Reagan Scofield</title>
  </head>
  <body>
    <nav id="navid" class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
          <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link text-white text-dark" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
              </ul>

      </div>
      </div>
    </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2">
        <ul class="nav flex-column mt-1">
          <li class="nav-item">
            <a id="nav"  class="nav-link" href="dashboard.php"><i class="fa fa-th"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a id="nav"  class="nav-link" href="categories.php"><i class="fa fa-tags"></i> Category</a>
          </li>
          <li class="nav-item">
            <a id="nav"   class="nav-link" href="addnewpost.php"><i class="fa fa-building-o"></i> Add New Post</a>
          </li>
          <li class="nav-item">
            <a id="nav"  class="nav-link" href="adminmanage.php"><i class="fa fa-user-o"></i> Manage Admin</a>
          </li>
          <li class="nav-item">
            <a id="nav"  class="nav-link active" href="comments.php"><i class="fa fa-comments"></i> Comments</a>
          </li>
          <li class="nav-item">
            <a id="nav"  class="nav-link" href="blog.php"><i class="fa fa-th-large"></i> Live Blog</a>
          </li>
          <li class="nav-item">
            <a  id="nav" class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a>
          </li>


        </ul>
      </div>

      <div class="col-sm-10 bg-light">
            <div class="container mt-4">
              <h1 class="mt-4 text-info mb-4" >Un-Approval Comments</h1>
                <?php echo successMessageFunction(); ?>
                <table class="table  table-responsive">
                  <thhead class="thead-info">
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Date & Time</th>
                      <th>Comment</th>
                      <th>ApproveBy</th>
                      <th>Approve</th>
                      <th>Delete Comment</th>
                      <th>Details</th>
                    </tr>
                  </thhead>

            <?php
                  //etablished connection with db
                  global $dbConnection;
                  // selecting databases
                  $selectingDB = "SELECT * FROM cooments WHERE status='OFF' ORDER BY datetime desc";
                  //running selecting
                  $runQuery = mysql_query($selectingDB);
                  // fetching data with while loop
                  $defaultID = 0;
                  while($fetchDATA = mysql_fetch_array($runQuery)) {
                      $id = $fetchDATA['ID'];
                      $name = $fetchDATA['name'];
                      $dateTime = $fetchDATA['datetime'];
                      $comments = $fetchDATA['addcomments'];
                      $defaultID++;

             ?>
                  <tbody>
                    <tr>
                      <td><?php echo $defaultID; ?></td>

                      <td>
                        <?php
                            // making text on the table to be short
                            if(strlen($name) > 6) {$name = substr($name, 0,6) . '...'; }
                            echo $name;
                        ?>
                      </td>

                      <td>
                        <?php
                            if(strlen($dateTime) > 15) {$dateTime = substr($dateTime, 0,15) . '...'; }
                            echo $dateTime;
                        ?>
                      </td>

    

                      <td>
                        <?php
                            // making text on the table to be short
                            //if(strlen($comments) > 12) {$comments = substr($comments, 0,12) . '...'; }
                            echo $comments;
                        ?>
                      </td>
                      <td>
                        <!--Edinting button with request of ajax  -->
                        <a href="approvecomments.php?id=<?php echo $id; ?>=<?php echo $id; ?>"><span class="btn btn-info btn-sm">Approve</span></a>
                      </td>
                      <td>
                        <!--Edinting button with request of ajax  -->
                        <a href="deletecomments.php?Delete=<?php echo $id; ?>"><span class="btn btn-danger btn-sm">Delete</span></a>
                      </td>

                      <td>
                        <a href="fullpost.php?id=<?php echo $id; ?>" target="blank"><span class="btn btn-warning btn-sm">Live Preview</span></a>
                      </td>
                    </tr>
                  </tbody>
<?php } ?> <!--Ending While loop  -->
                </table>
            </div>

<!-- approval comments section -->
<div class="container mt-4">
              <h1 class="mt-4 text-info mb-4" >Approved Comments</h1>
                <?php echo successMessageFunction(); ?>
                <table class="table  table-responsive">
                  <thhead class="thead-info">
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Date & Time</th>
                      <th>Comment</th>
                      <th>ApproveBy</th>
                      <th>Disapprove</th>
                      <th>Delete Comment</th>
                      <th>Details</th>
                    </tr>
                  </thhead>

            <?php
                  //etablished connection with db
                  global $dbconnection;
                  // selecting databases
                  $selectingDB = "SELECT * FROM cooments WHERE status='ON' ORDER BY datetime desc";
                  //running selecting
                  $runQuery = mysql_query($selectingDB);
                  // fetching data with while loop
                  $defaultID = 0;
                  while($fetchDATA = mysql_fetch_array($runQuery)) {
                      $id = $fetchDATA['ID'];
                      $name = $fetchDATA['name'];
                      $dateTime = $fetchDATA['datetime'];
                      $comments = $fetchDATA['addcomments'];
                      $approveby = $fetchDATA['approveby'];
                      $defaultID++;

             ?>
                  <tbody>
                    <tr>
                      <td><?php echo $defaultID; ?></td>

                      <td>
                        <?php
                            // making text on the table to be short
                            if(strlen($name) > 6) {$name = substr($name, 0,6) . '...'; }
                            echo $name;
                        ?>
                      </td>

                      <td>
                        <?php
                            if(strlen($dateTime) > 15) {$dateTime = substr($dateTime, 0,15) . '...'; }
                            echo $dateTime;
                        ?>
                      </td>

    

                      <td>
                        <?php
                            // making text on the table to be short
                            //if(strlen($comments) > 12) {$comments = substr($comments, 0,12) . '...'; }
                            echo $comments;
                        ?>
                      </td>
                      <td>
                        <?php
                            // making text on the table to be short
                            //if(strlen($comments) > 12) {$comments = substr($comments, 0,12) . '...'; }
                            echo $approveby;
                        ?>
                      </td>
                      <td>
                        <!--Edinting button with request of ajax  -->
                        <a href="disprovecomment.php?id=<?php echo $id; ?>"><span class="btn btn-info btn-sm">Disapprove</span></a>
                      </td>
                      <td>
                        <!--Edinting button with request of ajax  -->
                        <a href="deletecomments.php?Delete=<?php echo $id; ?>"><span class="btn btn-danger btn-sm">Delete</span></a>
                      </td>

                      <td>
                        <a href="fullpost.php?id=<?php echo $id; ?>" target="blank"><span class="btn btn-warning btn-sm">Live Preview</span></a>
                      </td>
                    </tr>
                  </tbody>
<?php } ?> <!--Ending While loop  -->
                </table>
            </div>
      </div>
    </div>
  </div>


  <div class="main-footer ">
    <div class="container text-center text-white">
      <h6 class="pt-4"> Copy Right &copy 2017 by Reagan Scofield </h6>
      <p  class="pb-4"><a href="#">Terms and Conditions</a> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti ratione nobis ut tenetur laborum illum.</p>
    </div>
  </div>
  <!--SCRPTS SECTIONS  -->
      <script src="js/jquery-3.2.1.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/main.js"></script>
  </body>
</html>
