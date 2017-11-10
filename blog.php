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
              <a class="nav-link text-info" href="#">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="login.php">Admin Panel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="contact.php">Contact Us</a>
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
          } //Paggination logical 
          else if(isset($_GET["Page"])) {
              $page = $_GET["Page"];
                  if($page == 0 || $page < 1) {
                    $showThePostFrom = 0;
                  } else {
                    $showThePostFrom = ($Page * 5) - 5;
                  }
              $selectingDB = "SELECT * FROM adminpanel ORDER BY datetime desc LIMIT $showThePostFrom,5";
          } //categories logical
          else if(isset($_GET['catName'])) {
              $getCatUrl = $_GET['catName'];
            $selectingDB = "SELECT * FROM adminpanel WHERE category='$getCatUrl' ORDER BY datetime desc";
          }
        
        //else { 
            //check to fixe latter code goes ending paratese on line 89
          //}

    // selecting all data from admin panel table
    $selectingDB = "SELECT * FROM adminpanel ORDER BY datetime desc LIMIT 0,3"; 
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
<!-- ===============================ENDIG#CODE=================================== --> 
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
                 if(strlen($post) > 200) {$post = substr($post, 0,200)
                   . ' ......'; }
                  echo $post;
              ?> <a href="fullpost.php?id=<?php echo $id; ?>">Read More &rsaquo; &rsaquo;</a>
              <!-- ===============================ENDIG#CODE=================================== --> 
            </p>
        </div>
      </div>
  <?php } ?> <!-- Ending while loop -->


<!-- Pigginations Section -->
  <nav aria-label="Page navigation example">
      <!-- ===============================CODE=================================== -->             
      <?php
          global $dbConnection;
          $selectDb = "SELECT COUNT(*) FROM adminpanel";
          $runQuery = mysql_query($selectDb);
          
          $fetchRows = mysql_fetch_array($runQuery);
                  $totalData  = array_shift($fetchRows);
                  $paggination = $totalData / 5;
                  $postPaggination = ceil($paggination);
                
              for($i = 1; $i <= $postPaggination; $i++ ) {           
      ?>
      <!-- ===============================ENDIG#CODE=================================== -->
          <ul class="pagination pull-left">
              <!-- <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li> -->
                  <li class="page-item"><a class="page-link" href="<?php echo $i; ?>"><?php echo $i; ?></a></li>
              <!-- <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li> -->
            </ul>
    <?php  }  ?> <!-- Ending while loop -->
  </nav>

</div>






<!-- ============================ -->
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
        $selectingDB = "SELECT * FROM adminpanel ORDER BY datetime desc LIMIT 0,2"; 
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


<!-- footer section -->
    <div  class="main-footer">
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
