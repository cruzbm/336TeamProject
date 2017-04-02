<?php
session_start();
include 'dataCon.php';


$dbConn = getDataBaseConnection(Project_1);
$device = array();
$price = array();
$size = 0;


    
    $sql = "SELECT DISTINCT * FROM device";
    
    
    if(isset($_POST['Submit'])){
        
     if($_POST['manufacturer'] == "apple")
     {
         $sql .= " NATURAL JOIN deviceInfo 
         WHERE manufactName = 'iPhone'";
        
     }
      if($_POST['manufacturer'] == "htc")
     {
         $sql .= " NATURAL JOIN deviceInfo 
         WHERE manufactName = 'HTC'";
        
     }
      if($_POST['manufacturer'] == "LG")
     {
         $sql .= " NATURAL JOIN deviceInfo 
         WHERE manufactName = 'LG'";
        
     }
      if($_POST['manufacturer'] == "Samsung")
     {
         $sql .= " NATURAL JOIN deviceInfo 
         WHERE manufactName = 'Samsung'";
         
     }
        
    if($_POST['priceFilter'] == "high"){

        $sql .= " ORDER BY price DESC";
    }
    
    if($_POST['priceFilter'] == "low"){
        
        $sql .= " ORDER BY price ASC";
      
    }

        
    }

$statement = $dbConn->prepare($sql);
$statement->execute();
$record = $statement->fetchAll(PDO::FETCH_ASSOC);

$index = 0;

$id = array();






foreach($record as $records){
    $device[$index] = $records['name'];
    $price[$index] = $records['price'];
    $id[$index] = $records['deviceId'];
    $index++;
    $size++;
}


function makeTable(){
    
    global $device;
    global $price;
    global $id;
    global $size;
    
    $index = 0;

    echo "<table border = '1'>";
    $temp = 1;
    $t = 0;
    
    for($i=0; $i < 4; $i++){
        
        echo "<tr>";
        
        for($j=0; $j < 5; $j++){
            
            if($t == $size){
                
                break;
            }
            
            echo "<td> ";
            echo "<img src='img/sm" .$id[$index]. ".jpg'/>";
            echo "<br />"; 
            echo $device[$index] . "<br /> $" . $price[$index];
            echo "<input type='checkbox' name= 'stack[]'" . "value =" . $id[$index] . ">";
            echo "</td>";
            $temp++;
            $index++;
            $t++;
        }
        echo "</tr>";
        
        if($t == $size){
            
            break;
        }
        
    }
    
}
    
if(isset($_POST['continue'])){
    $_SESSION['info'] = array();
    $_SESSION['info'] = $_POST['stack'];
    echo $_SESSION['info'][0];
    header('Location: info.php');
}


?>

<!DOCTYPE html>
<html>
    
   <link rel = "stylesheet" href = "tp1.css" type = "text/css" />
    
    <head>
        <title> Online Phone Catalog</title>
    </head>
    <h1> Smart Phones for Sale! </h1>
    
    <nav a>
        <a href="main.php" float:right> Main Menu </a>
        <a href="shopCart.php" float:right> Cart </a>
        <a href="UserStory.docx"> User Story</a>
        <a href="login.php" float:right> Log out </a>
        
    </nav>
    
    
    
    <body>
        
            
            
            <br />
            
            
            
             <form method = "POST">  
            
            <fieldset>
            <div><legend>Sort by:</legend>
            Price     
            <select name ="priceFilter">
                <option value =""> Choose One </option>
                 <option value="high">High to Low</option>
                 <option value="low">Low to High</option>
            </select>
            
                Manufacturer        
            <select name ="manufacturer">
                <option value =""> All </option>
                 <option value="apple">Apple</option>
                 <option value="htc">HTC</option>
                 <option value="LG">LG</option>
                 <option value="Samsung">Samsung</option>
            </select>
                Feature       
            <select name ="feature">
                <option value =""> All </option>
                 <option value="4G_HSPA">4G HSPA</option>
                 <option value="4G_LTE">4G LTE</option>
                 <option value="LTEadvanced">LTE advanced</option>
            </select>

            <input type="submit" name="Submit" value="Apply" />
                <?=makeTable()?>
           <input type="submit" name = "continue" value="Continue"></div>
       
        </form>
         </fieldset>

    </body>
</html>