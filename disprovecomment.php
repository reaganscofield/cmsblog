<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>

<?php
    
    if(isset($_GET['id'])) {
        global $dbConnection;
        $getIDfromUrls = $_GET['id'];
        $selectComments = "UPDATE cooments SET status='OFF' WHERE id='$getIDfromUrls' ";

        $runQuery = mysql_query($selectComments);
            if($runQuery) {
                $_SESSION['successMessage'] = "You Have Successfull Disapproved this Comment";
                //Calling redirection and set  parameters of location
                redirectionToPages("comments.php");
            } else {
                $_SESSION['ErrorMessage'] = "We Couldn't Approve Your Comment Please Try Again Later";
                //Calling redirection and set  parameters of location
                redirectionToPages("comments.php");
            }
    }

?>