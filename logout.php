<?php require_once("include/sessions.php"); ?>
<?php require_once("include/function.php"); ?>

<?php
    $_SESSION["USERNAME"] = null;
    session_destroy();

    redirectionToPages("login.php");

?>