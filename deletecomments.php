<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>
          
                              
                <?php
                    global $dbConnection;
                    $deleteFromQueryParameters = $_GET['Delete'];
                    //inserting into db
                    $selectDeleting = "DELETE FROM cooments WHERE ID = '$deleteFromQueryParameters' ";
                    //runing insertions
                    $runQuery = mysql_query($selectDeleting);

                    if($runQuery) {
                      $_SESSION['successMessage'] = "You Have Successful Deleted Comments";
                      //Calling redirection and set  parameters of location
                      redirectionToPages("comments.php");
                    } else {
                      $_SESSION['secondErrorMessage'] = "Something Went Wrong Please Try Later";
                      //Calling redirection and set  parameters of location
                      redirectionToPages("comments.php");
                    }
                 ?>