<?php
    require_once("include.php");
    
    validateEnvironment();
    protect();
    
    # 1. redirect to the phpmyadmin page
    $header = "Location: https://".$_SERVER['SERVER_NAME']."/phpmyadmin/";
    header($header);

?>