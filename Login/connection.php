<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "irrigation_department";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if($conn-> connect_error){
        die("Connection failed".$conn->connect_error);
    }else{
    echo"";
    }
?>