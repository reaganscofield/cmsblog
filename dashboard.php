<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>
<?php //comfirmLogin(); ?>

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
            <a id="nav"  class="nav-link active" href="dashboard.php"><i class="fa fa-th"></i> Dashboard</a>
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
            <a id="nav"  class="nav-link" href="comments.php"><i class="fa fa-comments"></i> Comments</a>
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
              <h1 class="mt-4 text-info mb-4" >Admin Panel</h1>
                <?php echo successMessageFunction(); ?>
                <table class="table  table-responsive">
                  <thhead class="thead-info">
                    <tr>
                      <th>No</th>
                      <th>Post Title</th>
                      <th>Date & Time</th>
                      <th>Autor</th>
                      <th>Category</th>
                      <th>Image</th>
                      <th>Comments</th>
                      <th>Action</th>
                      <th>Details</th>
                    </tr>
                  </thhead>

            <?php
                  //etablished connection with db
                  global $dbconnection;
                  // selecting databases
                  $selectingDB = "SELECT * FROM adminpanel ORDER BY datetime desc";
                  //running selecting
                  $runQuery = mysql_query($selectingDB);
                  // fetching data with while loop
                  $defaultID = 0;
                  while($fetchDATA = mysql_fetch_array($runQuery)) {
                      $id = $fetchDATA['ID'];
                      $dateTime = $fetchDATA['datetime'];
                      $title = $fetchDATA['title'];
                      $category = $fetchDATA['category'];
                      $autor = $fetchDATA['autor'];
                      $image = $fetchDATA['image'];
                      $post = $fetchDATA['post'];
                      $defaultID++;

             ?>
                  <tbody>
                    <tr>
                      <td><?php echo $defaultID; ?></td>

                      <td>
                        <?php
                            // making text on the table to be short
                            if(strlen($title) > 6) {$title = substr($title, 0,6) . '...'; }
                            echo $title;
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
                            if(strlen($autor) > 7) {$autor = substr($autor, 0,7) . '...'; }
                            echo $autor;
                        ?>
                      </td>

                      <td>
                        <?php
                            // making text on the table to be short
                            if(strlen($category) > 6) {$category = substr($category, 0,6) . '...'; }
                            echo $category;
                        ?>
                      </td>
                    
                      <td><img src="fileUploads/<?php echo $image; ?>" width="100px" height="60px" alt=""></td>
                      
                      <td>
                          <!-- Counting the number of comment that have been approve -->
                          <?php
                              //global $dbConnection;
                              // selecting and counting all comments have status = ON
                              //$selectingDb = "SELECT COUNT(*) FROM cooments WHERE status='ON'";   //adminpanelid='$id' AND
                              //$runQuery = mysql_query($selectingDb);
                              // fetcing them with an array funvtion from php
                              //$rowsApproved = mysql_fetch_array($runQuery);
                              //$totalOfApproved = array_shift($rowsApproved);
                                  //if($totalOfApproved > 0) {     //begin of statements
                              ?>  <span class="badge badge-primary pull-right">
                                      <?php //echo $totalOfApproved; ?>
                                  </span>  
                            <?php //} ?>  <!--Ending Statements  -->

                          <?php
                              //global $dbConnection;
                              // selecting and counting all comments have status = OFF
                              //$selectingDb1 = "SELECT COUNT(*) FROM cooments WHERE status='OFF'";   //adminpanelid='$id' AND
                              //$runQuery1 = mysql_query($selectingDb1);
                              // fetcing them with an array funvtion from php
                              //$rowsApproved1 = mysql_fetch_array($runQuery1);
                              //$totalOfApproved1 = array_shift($rowsApproved1);
                                  //if($totalOfApproved1 > 0) {     //begin of statements
                              ?>  <span class="badge badge-info pull-left">
                                      <?php //echo $totalOfApproved1; ?>
                                  </span>  
                            <?php //} ?>  <!--Ending Statements  -->             
                      </td>

                      <td>
                        <!--Edinting button with request of ajax  -->
                        <a href="editpost.php?Edit=<?php echo $id; ?>"><span class="btn btn-info btn-sm">Edit</span></a>
                        <a href="deletepost.php?Delete=<?php echo $id; ?>"><span class="btn btn-danger btn-sm">Delete</span></a>
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


  <div class="main-footer">
    <div class="container text-center text-white">
      <h6 class="mt-3"> Copy Right &copy 2017 by Reagan Scofield </h6>
      <p><a href="#">Terms and Conditions</a> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti ratione nobis ut tenetur laborum illum.</p>
    </div>
  </div>
  <!--SCRPTS SECTIONS  -->
      <script src="js/jquery-3.2.1.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/main.js"></script>
  </body>
</html>
