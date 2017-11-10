<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>

<?php

    global $dbConnection;
    $deleteFromQueryParameters = $_GET['Delete'];
    //inserting into db
    $selectDeleting = "DELETE FROM category WHERE ID = '$deleteFromQueryParameters' ";
    //runing insertions
    $runQuery = mysql_query($selectDeleting);

    if($runQuery) {
    $_SESSION['successMessage'] = "You Have Successful Deleted Category";
    //Calling redirection and set  parameters of location
    redirectionToPages("categories.php");
    } else {
    $_SESSION['secondErrorMessage'] = "Sorry We Couldn't Delete Category Please Try Again Later";
    //Calling redirection and set  parameters of location
    redirectionToPages("categories.php");
    }

?>