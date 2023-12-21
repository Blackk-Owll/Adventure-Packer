<?php


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "knapsack_game";

    $conn  = mysqli_connect($servername, $username, $password, $dbname) ;
    if(!$conn){
        die("Connection echouée: " . mysqli_connect_error());
    }


?>