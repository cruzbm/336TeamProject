<?php
session_start();


if(isset($_POST['pay'])){
    
    unset($_SESSION['add']);
    
    echo "<div>Thank you for your purchase!</div>";

    
}



include 'dataCon.php';
$dbConn = getDataBaseConnection(Project_1);
if(!isset($_SESSION['add'])){
    
    $_SESSION['add'] = array();
    
    
}

for($i = 0; $i < 50; $i++){
        
    $_SESSION['add'][$i] = $_SESSION['info'][$i];
        
}
    
//echo isset($_SESSION['add']);

function cart(){
    global $dbConn;
    $total = 0;

$sql = "SELECT DISTINCT * FROM device";

        for($i=0; $i<30; $i++){
        if(in_array($i, $_SESSION['add'])){
            
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

if(isset($_SESSION['add'])){
    echo"<div><table border = '1' align = 'center'>";
foreach($record as $records){
    echo "<tr><td>";            
    echo "<img src='img/sm" .$records['deviceId']. ".jpg'/>";
    echo "<br />";
    echo $records['name'];
    echo "<br />";
    echo "$" . $records['price'];
    $total += $records['price'];
    echo "<br /></td></tr/>";                
            }  

echo "Total: $" . $total;

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
    <body>
        <h1> Shopping Cart</h1>
        
            <nav a>
        <a href="main.php" float:right> Main Menu </a>
        <a href="shopCart.php" float:right> Cart </a>
        <a href="UserStory.docx"> User Story</a>
        <a href="login.php" float:right> Log out </a>
        
    </nav>
            <?php
            
            if(isset($_SESSION['add'])){
                cart();
            }
            
            else{
                
                $_SESSION['add'] = array();
                
            }
            
            ?>
            
            <form method="POST">
                
                <div><input type ="Submit" name="pay" value="Checkout"/></div>
                
                
            </form>
        

    </body>
</html>