<?php

session_start();

include "dbConnection.php";
$dbConn = getDatabaseConnection('336TP');

function display(){
    global $dbConn;
    global $flag;
     
     
    //Initial print of all products
    if (!isset($_GET["filter"])){
        $sql = "SELECT *
                FROM Part";
                    
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo "<table>";
        
        $increment = 0;
        
        foreach ($record as $records){ 
            if ($increment%4 == 0){
                echo "<tr>";
            }
            
            echo "<td>" . 
                 "<img src='img/" . $records['imageId'] . ".jpg' height='80' width='80'>" . 
                 "<br />" . 
                 "<a href='desc.php'>" . $records['partName'] . "</a>" .
                 "<br />$" . 
                 $records['partPrice'] . 
                 "<br /> <input type='checkbox' name='addItem'>" .
                 "</td>"; 
                 $increment++;
                 
            if ($increment%4 ==0){
                echo "<tr>";
            }
        }
        
        
        echo "</table>";
    }
}


function getCal(){
    global $dbConn;
    
        $sql = "SELECT partCaliber
                FROM Part
                ORDER BY partCaliber";
                    
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        //Trying to remove duplicate data
        // $cal = array();
        // foreach ($record as $caliber){
        //     $cal[] = $caliber['partCaliber'];
        // }
        
        // $cals = array_unique($cal);
        
        // for ($i = 0; $i < sizeof($cals); $i++){
        //     echo "<option value='" . $cals[$i] . "'>" . $cals[$i] . "</option>";
        // }
        
        foreach ($record as $records){
            echo "<option value='" . $records['partCaliber'] . "'>" . $records['partCaliber'] . "</option>";
        }
}

function getAction(){
    echo "hello";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Team Project</title>
        <link rel="stylesheet" href="tp.css"></link>
    </head>
    <body>
        <h1>Guns 'r Fun Shop</h1>
        
        <div>
            <fieldset>
                <form name="filter">
                    <select name="caliber">
                        <option value="">Caliber</option>
                        <?=getCal()?>
                    </select>
                    
                    <input type="text" name="maxPrice" placeholder="Enter Max Price">
                    
                    <input type="checkbox" name="comWeap">Complete Build
                    
                    <input type="submit" value="Filter" onsubmit="getAction()">
                </form>
            </fieldset>
            
        </div>

        <div>
            <?=display()?>
        </div>
        
        <br />
        <br />
        
        <div>
            <input type="submit" name="addToCart" value="Add Items" onsubmit>
            <input type="submit" name="cart" value="See Cart" onsubmit>
            <input type="submit" name="checkout" value="Checkout" onsubmit>
        </div>
    </body>
</html>