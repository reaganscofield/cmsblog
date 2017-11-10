<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>
<?php

    if(isset($_POST['submit'])) {
      $name = mysql_escape_string($_POST['name']);
      $email = mysql_escape_string($_POST['email']);
      $comments = mysql_escape_string($_POST['comment']);
      //date and time variables 
      date_default_timezone_set('Africa/Johannesburg');
      $currrentTime = time();
      $dateTime = strftime("%B-%d-%Y %H:%M:%S", $currrentTime);
      $dateTime;
      //get a post id with super global
      $postID = $_GET['id'];
  
          if(empty($name)) {
            $_SESSION['ErrorMessage'] = "Please Enter Your Name";
          }
          else if(empty($email)) {
            $_SESSION['ErrorMessage'] = "Please Enter Your Email";
          }
          else if(empty($comments)) {
            $_SESSION['ErrorMessage'] = "Please Enter Your Comments";
          } 
          else if(strlen($comments) > 200) {
            $_SESSION['ErrorMessage'] = "Only 200 Characters are allowed ";
          } else {
            global $dbConnection;
            //
            $getIDfromURL = $_GET['id']; 
            
                  $insert = "INSERT INTO cooments(name, email, addcomments, approveby, datetime, status, adminpanelid) VALUES (
                                           '$name', '$email', '$comments', 'Reagan', '$dateTime', 'OFF', '$getIDfromURL' 
                                          )";
                  $runQuery = mysql_query($insert);
                    if($runQuery) {
                      $_SESSION['successMessage'] = "You have Successful Commented to this Post";
                      //getting id from super global and redirecte users with the same id 
                      redirectionToPages("fullpost.php?id={$postID}");
                    } else {
                      $_SESSION['ErrorMessage'] = "Sorry We Couldn't add your comments please check your internet connection and try again later";
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
    <!-- <link rel="stylesheet" href="css/admin.css"> -->
    <link rel="stylesheet" href="css/public.css">
    <title>CMS App | By Reagan Scofield</title>
  </head>
  <body>
<nav id="navid" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
      <a class="navbar-brand" href="#">PrograNews</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-info" href="blog.php">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Feature</a>
            </li>
          </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search" aria-label="Search">
          <button class="btn btn-outline-info my-2 my-sm-0" name="search" type="submit">Search</button>
        </form>
  </div>
  </div>
</nav>



<!-- ======================== -->
<!-- Main Areas -->
<div id="mar-t" class="container mt-4">
    <h1 class="text-info">Progrmming and Hacking News Blog</h1>
    <h6>Developer By Reagan Scofield Moukandila, Power With PHP and MySQL</h6>

<div class="row mt-3">
    <div class="col-lg-8">
<!-- ===============================CODE=================================== -->
<?php
    // connecting to databases
    global $dbConnection;
    // activing search button
    if(isset($_GET['search'])) {
        $searchFromDB = $_GET['search'];
        $selectResulta = "SELECT * FROM adminpanel WHERE datetime LIKE '%$searchFromDB%' OR title LIKE
                          '%$searchFromDB%' OR category LIKE '%$searchFromDB%' OR post LIKE '%$searchFromDB%' ";
    } else {
        $postIDFromUrls = $_GET['id'];
        // selecting all data from admin panel table
        $selectingDB = "SELECT * FROM adminpanel WHERE ID = '$postIDFromUrls' ORDER BY datetime desc";  } //eding seach section
        $runSelect = mysql_query($selectingDB);
        // fetching data with while loop
        $defaultID = 0;
        while($takeDATA = mysql_fetch_array($runSelect)) {
            $id = $takeDATA['ID'];
            $dateTime = $takeDATA['datetime'];
            $title = $takeDATA['title'];
            $category = $takeDATA['category'];
            $autor = $takeDATA['autor'];
            $image = $takeDATA['image'];
            $post = $takeDATA['post'];
 ?>
 <!-- ===============================ENDING#CODE=================================== -->
      <div class="card mb-3">
        <img class="card-img-top" src="fileUploads/<?php echo $image; ?>" alt="Card image cap">
        <div class="card-body">
            <h4 class="card-title"><?php echo $title; ?></h4>
            <h6>Autor: <?php echo $autor; ?></h6>
            <h6>Category: <?php echo $category; ?></h6>
            <p class="card-text"><small class="text-muted">Posted On <?php echo $dateTime; ?></small></p>
            <p class="card-text"><?php echo $post;?></p>
        </div>
      </div>
  <?php } ?>  <!-- Ending While Loop   -->


    <span>Share what you think about this post with us</span>
    <!-- ===============================CODE=================================== -->
    <!-- extrating comments from databases -->
    <?php
        // etablish connection to db
        global $dbConnection;
        // getting post id from super global $_get
        $postID = $_GET['id'];
        $selectingdb = "SELECT * FROM cooments";   // WHERE adminpanelid = '$postID'
        $runQuery = mysql_query($selectingdb);
          // checking error in the query
          if($runQuery === FALSE) {
            die(mysql_error());
          }
        // running while loop to fetch data
        while($fetchData = mysql_fetch_array($runQuery)) {
              $name = $fetchData['name'];
              $datetime = $fetchData['datetime'];
              $comments = $fetchData['addcomments'];   
    ?>
    <!-- ===============================ENDIG#CODE=================================== --> 
        <!-- displaying comments datas -->
          <div class="ml-5 bg-light mt-3 pl-3">
              <img class="pull-left mt-2 " src="img/downloadv.png" width="40px" alt="">
              <p class="text-info ml-5"><?php echo $name; ?></p>
              <span class="text-muted ml-2 pt-1 "><small><?php echo $datetime; ?></small></span>
              <p class="ml-5"><?php echo $comments; ?></p>
          </div>
    <?php } ?> <!-- Ending comments while loop -->


    <!-- ===========ALERT CODE=============== -->
    <?php echo successMessageFunction(); ?>
    <?php echo errorMessageFunction(); ?>
<!-- Comment Form -->
    <form class="mb-5" action="fullpost.php?id={$postID}" method="POST">
            <div class="form-group">
              <label for="" class="font-weight-bold">Name</label>
              <input type="text" name="name" class="form-control">
              <span class="mt-5"><?php echo secondErrorMessageFunction(); ?></span>
            </div>
            <div class="form-group">
              <label for="" class="font-weight-bold">Email</label>
              <input type="text" name="email" class="form-control">
              <span class="mt-5"><?php secondErrorMessageFunction(); ?></span>
            </div>
            <div class="form-group">
                <label for="" class="font-weight-bold">Comments</label>
                <textarea type="text" name="comment" class="form-control"></textarea>
                <span class="mt-5"><?php echo secondErrorMessageFunction(); ?></span>
            </div>
            <input type="submit" name="submit" class="btn btn-block btn-info" value="Submit">
          </form>
    </div>


<!-- ============================= -->
<!-- side bar sections  -->
<div class="col-lg-4 text-center">
  <h3 class="text-center text-info">About Me</h3>
      <img class="rounded-circle" src="img/me.jpg" alt="">
      <p>of type and scrambled it to make a type specimen book. It has survived not only 
        but also the leap into electronic typesetting, remaining essentially unchanged. It was 
        content here', making it look like readable page editors now use default model popularised
        English. Many desktop publishing packages and web  Lorem Ipsum as their five centuries,
      </p>
      <!-- Fisrt Card -->
      <div class="card bg-light mb-3" >
          <div class="card-header bg-transparent border-info">
                <h2 class="card-title">Categories</h2>
          </div>
          <!-- ===============================CODE=================================== -->
              <?php
                  global $dbConnection;
                  $selectDb = "SELECT * FROM category ORDER BY datetime desc";
                  $runQuery = mysql_query($selectDb);
                  while($fetchData = mysql_fetch_array($runQuery)) { 
                    $id = $fetchData['id'];
                    $catName = $fetchData['name'];
                  
              ?>
          <!-- ===============================ENDING#CODE=================================== -->     
          <div class="card-body text-success">
                <a class="" href="blog.php?catName=<?php echo $catName ?>">
                  <p class="text-info"><b><?php echo $catName. '<br>'; ?></b></p>
                </a>
          </div>
        <?php } ?> <!-- =======Ending While Loop====== -->
        <div class="card-footer">
        </div>     
      </div>


  <!-- Second Card -->
  <div class="card bg-light mb-3" >
    <div class="card-header bg-transparent border-info">
      <h2 class="card-title">Recents Posted</h2>
    </div>
    <div class="card-body text-success">
      <div class="row mt-3">
        <div class="col-lg-12">
    <!-- ===============================CODE=================================== -->
    <?php
        // connecting to databases
        global $dbConnection;
        // selecting all data from admin panel table
        $selectingDB = "SELECT * FROM adminpanel ORDER BY datetime desc LIMIT 0,1"; 
        $runSelect = mysql_query($selectingDB);
        // fetching data with while loop
        $defaultID = 0;
        while($takeDATA = mysql_fetch_array($runSelect)) {
            $id = $takeDATA['ID'];
            $dateTime = $takeDATA['datetime'];
            $title = $takeDATA['title'];
            $category = $takeDATA['category'];
            $autor = $takeDATA['autor'];
            $image = $takeDATA['image'];
            $post = $takeDATA['post'];
    ?>
          <!-- ===============================ENDING#CODE=================================== -->
              <div class="card mb-3">
                <img class="card-img-top" src="fileUploads/<?php echo $image; ?>" alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title"><?php echo $title; ?></h4>
                    <h6>Autor: <?php echo $autor; ?></h6>
                    <h6>Category: <b><?php echo $category; ?></b> </h6>
                    <p class="card-text"><small class="text-muted">Posted On <?php echo $dateTime; ?></small></p>
                    <p class="card-text">
                      <!-- ===============================CODE=================================== -->
                      <?php
                          //making text less than 150 characters
                          if(strlen($post) > 150) {$post = substr($post, 0,150)
                            . ' ......'; }
                            echo $post;
                      ?> <a href="fullpost.php?id=<?php echo $id; ?>">Read More &rsaquo; &rsaquo;</a>
                      <!-- ===============================ENDINGCODE=================================== -->
                      </p>
                  </div>
              </div>
    <?php } ?> <!-- Ending while loop -->       
  </div>     
</div>             
</div>
</div>
</div>
</div>
</div>
</div>




<!-- footer section -->
    <div class="main-footer">
      <div class="container text-center text-white">
        <h6 class="pt-4"> Copy Right &copy 2017 by Reagan Scofield </h6>
        <p class="pb-4"><a href="#">Terms and Conditions</a> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti ratione nobis ut tenetur laborum illum.</p>
      </div>
    </div>

<!--SCRPTS SECTIONS  -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
