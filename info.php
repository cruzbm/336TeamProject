<?php
session_start();

$sel = array();
$sel = $_SESSION['info'];
$_SESSION['add'] = array();
include 'dataCon.php';

$dbConn = getDataBaseConnection(Project_1);


if(isset($_POST['add'])){
    
    

    echo "<div>Your item(s) have been added to your cart!</div>";
}




function showInfo(){
    
    global $sel;
    global $dbConn;
    
    $start = 0;
    
            
    $sql = "SELECT DISTINCT * FROM device
    NATURAL JOIN deviceInfo";
            
            
        for($i=0; $i<30; $i++){
        
        if(in_array($i, $sel)){
            
            if($start == 0){
            
                $sql .= " WHERE deviceId = '" . $i . "'";
                $start++;
            }
            
            else{
                $sql .= " OR deviceId = '" . $i . "'";
                
            }
            
        }
        
        
    }    

    
            $statement = $dbConn->prepare($sql);
            $statement->execute();
            $record = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo "<div><table border = '1' align = 'center'>";
            foreach($record as $records){
                echo "<tr><td>";
                echo "<img src='img/sm" .$records['deviceId']. ".jpg'/>";
                echo "<br />";
                echo $records['name'];
                echo "<br />";
                echo "Price: $" . $records['price'];
                echo "<br />";                
                echo "Manufacturer: " . $records['manufactName'];
                echo "<br />";
                echo $records['feature'];
                echo "<br />";
                echo "Condition: " . $records['deviceCondition'];
                echo "<br /></td></tr>";
        
            }  
    
    echo "</div>";

    
    
    
    
}




?>

<!DOCTYPE html>
<html>
    <link rel = "stylesheet" href = "tp1.css" type = "text/css" />
    <head>
        <title> Online Phone Catalog</title>
    </head>
    <h1> Device Info</h1>
    <nav a>
        <a href="main.php" float:right> Main Menu </a>
        <a href="shopCart.php" float:right> Cart </a>
        <a href="UserStory.docx"> User Story</a>
        <a href="login.php" float:right> Log out </a>
        
    </nav>
    
    <body>
        
            <?=showInfo()?>
        <form method = "POST">
            
           <div><button type="submit" value="add" name = "add">Add to cart</button></div>
            <br />
            
            
        </form>
    
    </body>
</html>