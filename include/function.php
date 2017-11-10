<?php

    //setting redirection function (router)
    function redirectionToPages($newLocation) {
      header("Location:" .$newLocation);
      exit;
    }

 ?>
