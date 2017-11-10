<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>

<?php

if(isset($_POST['submit'])) {

      $name = mysql_escape_string($_POST['name']);
      $email = mysql_escape_string($_POST['email']);
      $message = mysql_escape_string($_POST['message']);
      
      //checking empty field
      if(empty($name)) {
        $_SESSION['ErrorMessage'] = "Please Enter Your Name";
        header("Location: contact.php");
        exit;
      }
      else if(empty($email)) {
        $_SESSION['Error3Message'] = "Please Enter Your Email";
        header("Location: contact.php");
        exit;
      }
      else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['Error3Message'] = "Your Email is Invalid Make Sure You Enter Valid Email";
        header("Location: contact.php");
        exit;
      }
      else if(empty($message)) {
        $_SESSION['secondErrorMessage'] = "Please Enter Your Message";
        header("Location: contact.php");
        exit;
      } else {

      $sendTo = "reaganscofieldkayemb@gmail.com";
        $mailSubject = $name;
        $email = $email;
        $yourMesssage = $message;
        
        if(mail($sendTo, $email, $mailSubject, $yourMesssage)) {
            $_SESSION['successMessage'] = "You Have Been Send Successful We Will Get Back to You as soon as possible ";
            //Calling redirection and set  parameters of location
            redirectionToPages("contact.php");
        } else {
            $_SESSION['Error2Message'] = "Something Went Wrong Please Try Again Later";
            header("Location: contact.php");
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
                  <a class="nav-link text-white" href="login.php">Admin Panel</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="#">Feature</a>
                </li>
              </ul>

      </div>
      </div>
    </nav>

      <div id="fot" class="bg-light mt-5" id="marginb">
        <h1 class="mt-4 text-info text-center">Contact The Admin</h1>
        <div class="container  w-50 p-3">
          <div class="container">
               <div class="container-fluid">
               <?php echo successMessageFunction(); ?>
               <?php echo Error2MessageFunction(); ?>
                    <div class="">
                        <form class="mb-5" action="contact.php" method="POST">

                            <div class="form-group">
                                <label for="" class="font-weight-bold">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name">
                                <span class="mt-5"><?php echo errorMessageFunction(); ?></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="" class="font-weight-bold">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Email">
                                <span class="mt-5 "><?php echo Error3MessageFunction(); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Message</label>
                                <textarea  name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                <span class="mt-5 "><?php echo secondErrorMessageFunction(); ?></span>
                            </div>
                            <input type="submit" name="submit" class="btn btn-block btn-info" value="Submit">

                        </form>
                    </div>
               </div>
          </div>
        </div>
    </div>
</div>

  <div class="main-footer bg-dark">
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
