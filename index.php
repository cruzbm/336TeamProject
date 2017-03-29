<?php

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
            echo "<td>" .
                 "<img src='img/" . $records['imageId'] . ".jpg' height=45 width=45>" .
                 "<br />" .
                 $records['partName'] . 
                 "<br />" .
                 $records['partPrice'] .
                 "</td>";
                 $increment++;
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
                        <?=getCal()?>
                    </select>
                    
                    <input type="submit">
                </form>
            </fieldset>
            
        </div>

        <div>
            <?=display()?>
        </div>
        
        
    </body>
</html>