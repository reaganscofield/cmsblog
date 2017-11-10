<?php require_once("include/dbconnection.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>

<?php

    //setting redirection function (router)
    function redirectionToPages($newLocation) {
        header("Location:" .$newLocation);
        exit;
    }
        // conditionning Restring page 
        //this functions will required login in some of the pages
        function login(){
            if(isset($_SESSION["USERNAME"])) {
                return true;
            }
        }
        // if there not login they will be send to login.php
        function comfirmLogin() {
            if(!login()) {
                redirectionToPages("login.php");
            }
    
        } 
 ?>