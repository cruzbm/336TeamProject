<?php

function getDatabaseConnection($dbname){
    $host = "localhost";
    $dbname = "Project_1";
    $username = "quez5481";
    $password = "";
    
    //Creates a database connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Setting Errorhandling to Exception
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    return $dbConn;    
}



?>