<?php
// Start the session
session_start();
/*
if(empty($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
array_push($_SESSION['cart'],$_POST['option']);
*/ if(!isset($_SESSION['option']))
       {
         $_SESSION["option"] = array();
       }



 if(isset($_POST['submit']))
        {
         foreach($_SESSION["option"] as $val)
         {
        echo '<div > This is the shopping cart contents '.$val.'</div>';
        
          
         }
         
         
        }
  if(!isset($_POST['submit']))
       {
         $_SESSION["option"] = array();
       }
       
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  if(!empty($_POST['option']))
  {
    foreach($_POST['option'] as $selected)
    {
        array_push($_SESSION['option'], $selected);
    }
  }
  
}
if(isset($_POST['clear']))
       {
        session_unset($_SESSION['option']);
        session_destroy();
        
        
       }
  
?>
<html>
  <head>
      
  </head>  
  <body>
      <h1 align = "center">Select the game that you wish to purchase</h1>
    <div align = "center">
      <form action="addToCart.php" method="POST">
            
            
                <div >Select your option: </div>
                <select multiple name="option[]">
                  <?php
                  
       // Set the Cloud 9 MySQL related information...this is set in stone by C9!
$servername = getenv('IP');
$dbPort = 3306;

// Which database (the name of the database in phpMyAdmin)
$database = "Vidya2";

// My user information...I could have prompted for password, as well, or stored in the
// environment, or, or, or (all in the name of better security)
$username = getenv('C9_USER');
$password = "";

// Establish the connection and then alter how we are tracking errors (look those keywords up)
$dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        $sql ="SELECT Game.*
                FROM Game
                ";
        $counter = 0;
        $stmt = $dbConn->prepare($sql);
        $stmt->execute ();
          while($row = $stmt -> fetch())
        {   
           
           echo'<option value='.$row['gameId'].'>'.$row['gameName'].'</option>';
         
            
        }
        echo'<br></br>';
        echo'<input type="submit" name="submit" value="Add To Shopping Cart"/><input type="submit" name="clear" value="Clear All"/>';
      
                  ?>
                    
                   
                </select>
  </form>
  </div>
      
      
      
<?php

//session_start();
//$wherein = implode(',',$_SESSION['cart']);
 
       // Set the Cloud 9 MySQL related information...this is set in stone by C9!
$servername = getenv('IP');
$dbPort = 3306;

// Which database (the name of the database in phpMyAdmin)
$database = "Vidya2";

// My user information...I could have prompted for password, as well, or stored in the
// environment, or, or, or (all in the name of better security)
$username = getenv('C9_USER');
$password = "";

// Establish the connection and then alter how we are tracking errors (look those keywords up)
$dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        $sql ="SELECT Game.*
                FROM Game
                ";

        $stmt = $dbConn->prepare($sql);
        $stmt->execute ();
     echo'<table style="width:100%" >';
         echo'<tr>
              
                <td> Game ID</td>
                <td> Game Name</td>
                <td> Maturity</td>
                <td> Genre</td>
                <td> Rating</td>
                
                
              </tr>';
        
        while($row = $stmt -> fetch())
        {   
           
            echo'<tr>';
            echo'<td>'.$row['gameId'].'</td>';
             echo'<td>'.$row['gameName'].'</td>';
            echo'<td>'.$row['maturity'].'</td>';
            echo'<td>'.$row['genre'].'</td>';
            echo'<td>'.$row['rating'].'</td>';
            echo' </tr>';
            
        }
         echo'</table>';
        
?>


   
    
    
    <div>
         
    <a href = "storeFront.php">Go Back To Main Page</a><!--- This Would have to be going back to the main page -->
    </div>
  </body>
</html>