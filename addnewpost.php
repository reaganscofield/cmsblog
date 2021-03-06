<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>

<?php

if(isset($_POST['submit'])) {
      $title = mysql_escape_string($_POST['title']);
      $category = mysql_escape_string($_POST['categories']);
      $post = mysql_escape_string($_POST['post']);
      //date and times
      date_default_timezone_set('Africa/Johannesburg');
      $currrentTime = time();
      $dateAndTime = strftime("%B-%d-%Y %H:%M:%S", $currrentTime);
      $dateAndTime;
      $creatorName = $_SESSION["USERNAME"];
      // image
      $image = $_FILES['image'] ['name'];
      $saveImage = "fileUploads/".basename($_FILES['image'] ['name']);
      move_uploaded_file($_FILES['image'] ['tmp_name'], $saveImage);


      //checking empty field
      if(empty($title)) {
        $_SESSION['ErrorMessage'] = "Please Fill Up the Title";
        header("Location: addnewpost.php");
        exit;
      }
      //checking empty field
      elseif(empty($post)) {
        $_SESSION['Error2Message'] = "Please Fill Up the Post Field";
        header("Location: addnewpost.php");
        exit;
      }
      //Chcking if the name of cat is more 14 characters
      elseif(strlen($title) > 40) {
        $_SESSION['ErrorMessage'] = "Your Title Name Must Contents at Least 10 Characters";
        header("Location: addnewpost.php");
        exit;
      } else {
            //Connecting db with global variabe from outside of this file
            global $dbConnection;
            //inserting into db
            $insert = "INSERT INTO adminpanel(datetime, title, category, autor, image, post) VALUES ('$dateAndTime',
                                      '$title', '$category', '$creatorName', '$image', '$post')";
              //runing insertions
            $runQuery = mysql_query($insert);

                if($runQuery) {
                  $_SESSION['successMessage'] = "You Have Posted Successful ";
                  //Calling redirection and set  parameters of location
                  redirectionToPages("addnewpost.php");
                } else {
                  $_SESSION['secondErrorMessage'] = "Sorry We Couldn't Added Your Information Check Your Internet Connection and Try Again";
                  //Calling redirection and set  parameters of location
                  redirectionToPages("addnewpost.php");
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
                <li class="nav-item">
                  
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
            <a id="nav"  class="nav-link " href="categories.php"><i class="fa fa-tags"></i> Category</a>
          </li>
          <li class="nav-item">
            <a id="nav"   class="nav-link active" href="addnewpost.php"><i class="fa fa-building-o"></i> Add New Post</a>
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
        <h1 class="mt-4 text-info">Add New Post</h1>

        <div class="container  w-75 p-3">

          <?php echo successMessageFunction(); ?>
          <?php echo secondErrorMessageFunction(); ?>

          <form class="mb-5" action="addnewpost.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="" class="font-weight-bold">Title</label>
              <input type="text" name="title" class="form-control">
              <span class="mt-5"><?php echo errorMessageFunction(); ?></span>
            </div>

            <div class="form-group">
              <label for="" class="font-weight-bold">Category</label>
            <select name="categories" class="form-control">
                  <?php
                        //connecting to db with global variable from outside of this File
                        global $dbConnection;
                        //selecting all data from category table
                        $selectDB = "SELECT * FROM category  ORDER BY datetime desc";
                        $runQuery = mysql_query($selectDB);
                        //fetching data with while loop
                        while($dataRows = mysql_fetch_array($runQuery)) {
                          $categoryName2 = $dataRows['name'];
                   ?>
                <option><?php echo $categoryName2; ?></option>
               <?php } ?>  <!--Ending While Loop  -->
            </select>
            </div>

            <div class="form-group">
                <label for="" class="font-weight-bold">Select Image</label>
                <input type="FILE" name="image" class="form-control">
            </div>

            <div class="form-group">
                <label for="" class="font-weight-bold">Post</label>
                <textarea type="text" name="post" class="form-control"></textarea>
                <span class="mt-5"><?php echo error2MessageFunction(); ?></span>
            </div>

            <input type="submit" name="submit" class="btn btn-block btn-success" value="Submit">
          </form>
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
