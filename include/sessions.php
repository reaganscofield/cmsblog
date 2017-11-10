<?php

  session_start();

//MAKING A FUNCTIONS MMESSAGE SUCCESSS AND WRONG

  //Success message function
  function successMessageFunction() {
    if(isset($_SESSION['successMessage'])) {
      $outPut = '<div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> ' . $_SESSION["successMessage"].'</DIV>';
      //Setting it NULL tO never stay displayied
      $_SESSION["successMessage"] = NULL;
      //return variavble
      return $outPut;
    }
  }

    //Second Success message function
    function success2MessageFunction() {
      if(isset($_SESSION['success2Message'])) {
        $outPut = '<div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> ' . $_SESSION["success2Message"].'</DIV>';
        //Setting it NULL tO never stay displayied
        $_SESSION["success2Message"] = NULL;
        //return variavble
        return $outPut;
      }
    }

    //Error message function
    function errorMessageFunction() {
      if(isset($_SESSION['ErrorMessage'])) {
        $outPut = '<div class="alert alert-danger">' .$_SESSION["ErrorMessage"].'</DIV>';
        //Setting it NULL tO never stay displayied
        $_SESSION["ErrorMessage"] = NULL;
        //return variavble
        return $outPut;
      }
    }

  //Second Error message function
  function secondErrorMessageFunction() {
    if(isset($_SESSION['secondErrorMessage'])) {
      $outPut = '<div class="alert alert-danger">' .$_SESSION["secondErrorMessage"].'</DIV>';
      //Setting it NULL tO never stay displayied
      $_SESSION["secondErrorMessage"] = NULL;
      //return variavble
      return $outPut;
    }
  }

  //post field error message function
  function Error2MessageFunction() {
    if(isset($_SESSION['Error2Message'])) {
      $outPut = '<div class="alert alert-danger">' .$_SESSION["Error2Message"].'</DIV>';
      //Setting it NULL tO never stay displayied
      $_SESSION["Error2Message"] = NULL;
      //return variavble
      return $outPut;
    }
  }

    //post field error message function
    function Error3MessageFunction() {
      if(isset($_SESSION['Error3Message'])) {
        $outPut = '<div class="alert alert-danger">' .$_SESSION["Error3Message"].'</DIV>';
        //Setting it NULL tO never stay displayied
        $_SESSION["Error3Message"] = NULL;
        //return variavble
        return $outPut;
      }
    }


 ?>
