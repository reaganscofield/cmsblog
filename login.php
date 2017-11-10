<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>

<?php

if(isset($_POST['submit'])) {

      $userName = mysql_escape_string($_POST['username']);
      $password = mysql_escape_string($_POST['password']);
      //$passwordConfirm = mysql_escape_string($_POST['passwordconfirm']);
    

      //checking empty field
      if(empty($userName)) {
        $_SESSION['ErrorMessage'] = "Please Enter Username";
        header("Location: login.php");
        exit;
      }
   
      else if(empty($password)) {
        $_SESSION['Error3Message'] = "Please Enter Your Password";
        header("Location: login.php");
        exit;
      }
    else {
        //Connecting db with global variabe from outside of this file
            global $dbConnection;
            //inserting into db
            $selectDB = "SELECT * FROM adminuser WHERE username = '$userName' AND password = '$password' "; 

            //runing insertions
            $runQuery = mysql_query($selectDB);
                    if($fetchAdmin = mysql_fetch_assoc($runQuery)) {
                        if($fetchAdmin) {
                            $_SESSION["USERNAME"] = $fetchAdmin['username'];
                            $_SESSION['successMessage'] = "Welcome To Administation Dashbaord Dear {$_SESSION["USERNAME"]} ";
                            header("Location: dashboard.php");
                            exit;
                          }
                        } else {
                            $_SESSION['Error2Message'] = "Username or Password are Invalid Please Try Again";
                            header("Location: login.php");
                            exit;
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
  <body class="bg-light">
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

      </div>
      </div>
    </nav>

      <div class="bg-light mt-5" id="marginb">
        <h1 class="mt-4 text-info text-center">Manage Admin Login</h1>
        <div class="container  w-50 p-3">
          <div class="container">
               <div class="container-fluid">
               <?php echo Error2MessageFunction(); ?>
                    <div class="">
                        <form class="mb-5" action="login.php" method="POST">

                            <div class="form-group">
                                <label for="" class="font-weight-bold">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username">
                                <span class="mt-5"><?php echo errorMessageFunction(); ?></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="" class="font-weight-bold">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <span class="mt-5 "><?php echo Error3MessageFunction(); ?></span>
                            </div>
                            <input type="submit" name="submit" class="btn btn-block btn-info" value="Submit">

                        </form>
                    </div>
               </div> 
          </div>
        </div>     
    </div>
</div>

  <!-- <div class="main-footer bg-dark">
    <div class="container text-center text-white">
      <h6 class="mt-3"> Copy Right &copy 2017 by Reagan Scofield </h6>
      <p><a href="#">Terms and Conditions</a> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti ratione nobis ut tenetur laborum illum.</p>
    </div>
  </div> -->
  <!--SCRPTS SECTIONS  -->
      <script src="js/jquery-3.2.1.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/main.js"></script>

  </body>
</html>

