<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>

<?php

if(isset($_POST['submit'])) {

      $categoryName = mysql_escape_string($_POST['category']);

      //date and times
      date_default_timezone_set('Africa/Johannesburg');
      $currrentTime = time();
      $dateAndTime = strftime("%B-%d-%Y %H:%M:%S", $currrentTime);
      $dateAndTime;
      $creatorName = $_SESSION["USERNAME"];

      //checking empty field
      if(empty($categoryName)) {
        $_SESSION['ErrorMessage'] = "Please Fill Up the Category Name";
        header("Location: categories.php");
        exit;
      } //Chcking if the name of cat is more 14 characters
      elseif(strlen($categoryName) > 50) {
        $_SESSION['ErrorMessage'] = 'Your Catrgory Name Must Contents at Least 50 Characters';
        header("Location: categories.php");
        exit;
      }  else {
        //Connecting db with global variabe from outside of this file
        global $dbConnection;
          //inserting into db
          $insert = "INSERT INTO category (datetime, name, creatorname) VALUES ('$dateAndTime',
                                  '$categoryName', '$creatorName')";
          //runing insertions
          $runQuery = mysql_query($insert);

          if($runQuery) {
            $_SESSION['successMessage'] = "You Have Successful Added The Category";
            //Calling redirection and set  parameters of location
            redirectionToPages("categories.php");
          } else {
            $_SESSION['secondErrorMessage'] = "Sorry We Couldn't Added Your Information Check Your Internet Connect and Try Again";
            //Calling redirection and set  parameters of location
            redirectionToPages("categories.php");
          }
      }
}

 ?>

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
        <ul class="nav flex-column">
          <li class="nav-item">
            <a id="nav"  class="nav-link" href="dashboard.php"><i class="fa fa-th"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a id="nav"  class="nav-link active" href="categories.php"><i class="fa fa-tags"></i> Category</a>
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
        <h1 class="mt-4 text-info">Add Categories</h1>
        <?php echo secondErrorMessageFunction(); ?>
        <div class="container  w-75 p-3">
          <?php echo successMessageFunction(); ?>
          <form class="mb-5" action="categories.php" method="POST">

            <div class="form-group">
              <label for="" class="font-weight-bold">Cotgory Name</label>
              <input type="text" name="category" class="form-control">
              <span class="mt-5"><?php echo errorMessageFunction(); ?></span>
            </div>
            <input type="submit" name="submit" class="btn btn-block btn-success" value="Submit">

          </form>
        </div>

        <!--Displaying Data  -->
        <div class="">
        <table class="table table-responsive table-hover  mb-5">
          <thhead class="thead-inverse">
            <tr>
              <th>ID</th>
              <th>Date and Time</th>
              <th>Category Name</th>
              <th>Creator Name</th>
              <th>Action</th>
            </tr>
          </thhead>

          <?php

                //connecting to db with global variable from outside of this File
                global $dbconnection;
                //selecting all data from category table
                $selectDB = "SELECT * FROM category  ORDER BY datetime desc";
                $runQuery = mysql_query($selectDB);
                //fetching data with while loop
                $defaultID = 0;
                while($dataRows = mysql_fetch_array($runQuery)) {
                  $id = $dataRows['id'];
                  $datetime = $dataRows['datetime'];
                  $categoryName2 = $dataRows['name'];
                  $creatorName2 = $dataRows['creatorname'];
                  $defaultID++;

           ?>

          <tbody>
            <tr>
              <td><?php echo $defaultID; ?></td>
              <td><?php echo $datetime; ?></td>
              <td><?php echo $categoryName2; ?></td>
              <td><?php echo $creatorName2; ?></td>
              <td><a href="deletecategories.php?Delete=<?php echo $id; ?>"><span class="btn btn-danger btn-sm">Delete</span></a></td>
            </tr>
          </tbody>

<?php } ?>   <!--Ending while loop  -->

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
