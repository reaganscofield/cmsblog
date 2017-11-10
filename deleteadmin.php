<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>

<?php

    global $dbConnection;
    $deleteFromQueryParameters = $_GET['Delete'];
    //inserting into db
    $selectDeleting = "DELETE FROM adminuser WHERE ID = '$deleteFromQueryParameters' ";
    //runing insertions
    $runQuery = mysql_query($selectDeleting);

    if($runQuery) {
    $_SESSION['success2Message'] = "You Have Successful Deleted Admin User";
    //Calling redirection and set  parameters of location
    redirectionToPages("adminmanage.php");
    } else {
    $_SESSION['secondErrorMessage'] = "Sorry We Couldn't Delete Admin User Please Try Again Later";
    //Calling redirection and set  parameters of location
    redirectionToPages("adminmanage.php");
    }

?>