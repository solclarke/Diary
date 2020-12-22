<?php 
    // Connect to database:
    $link = mysqli_connect("host", "username", "password", "database");
   
    // check database connection
    if(!$link) { // if it isn't connected
        echo "Connection error: " . mysqli_connect_error();
    }

?>