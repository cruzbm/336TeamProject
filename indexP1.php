<?php

    //Database Connection established
    include "../../Includes/dbConnection.php";
    $dbConn = getDatabaseConnection('tp336');
    
    function displayImgs(){
        
    }
    
    function getBrands(){
        global $dbConn;
        
        //Print list of all brands
        $sql = "SELECT name, brand
                FROM Shoes";
                
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $brands = array();
        foreach($records as $brand){
            $brands[] = $brand['brand'];
        }
        
        echo "<hr><h3><font color='white' face='arial black'>";
        for ($i = 1; $i < count($brands); $i++){
            if ($brands[$i] != $brands[$i-1]){
                echo $brands[$i-1] . " | ";
                echo $brands[$i] . "<br />";
            }
        }
        echo "</font></h3><hr>";
    }
    
    
    function filterShoes(){
        //NEEDS TO PRINTER FILTER BASED ON SQL FUNCTIONS
        //ALSO NEEDS TO ADD IN CHECKBOX BESIDE EACH OPTION DISPLAYED
        //WITH BUTTON TO ADD TO CART
        
    }
    
?>


<!DOCTYPE html>
<html>
    <!-- Include css here -->
    
    <head>
        <title>ShoeShopper Main Page</title>
    </head>
    
    <link rel="stylesheet" href="p1.css"> </link>
    
    <body>
        <h1>ShoeShopper Online</h1>
        
        <!-- initial print of available brands -->
        <?=getBrands()?>
          <?=displayImgs()?>
        <form name="filter">
            
        <!---------------------Menu Bar------------------------------------->    
        <fieldset>
            <legend>Filter Options</legend>
            Price     
            <select name ="priceFilter">
                 <option value="high">High to Low</option>
                 <option value="low">Low to High</option>
            </select>
            
                Color         
            <select name ="colorFilter">
                 <option value="black">Black</option>
                 <option value="white">White</option>
                 <option value="red">Red</option>
            </select>
                      Style         
            <select name ="styleFilter">
                 <option value="sneakers">Black</option>
                 <option value="boots">Boots</option>
                 <option value="flats">Flats</option>
            </select>
            
            <br />
            <input type="submit" name="Submit" value="Apply" />
        </fieldset>
        <!------------------------------------------------------------------>
        </form>
        
        <!------------ WILL DISPLAY OPTIONS HERE ----------------------------->
        <?php
        
        if(isset($_GET['filter'])){
            filterShoes(); //NEED TO CREATE FUNCTION
        }
        
        ?>
        <!------------------------------------------------------------------>
    </body>
</html>