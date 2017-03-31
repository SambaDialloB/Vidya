<!DOCTYPE html>
<html>
    <head>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Linking my CSS -->
         <link rel = "stylesheet" type =" text/css" href = "style.css"/>
         <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
         <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
        <title>Add to Cart</title>
        
    </head>
    
    <body class = "changeColor bodyChange">
<h1 align ="center"> <font color = "white" style = "font-family: Lobster"> Whatya Buying?</font></h1>
<?php
static $total = 0;
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
    if(!isset($_POST['submit']))
       {
         $_SESSION["option"] = array();
       }



 if(isset($_POST['submit']))
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
    
                if(!empty($_POST['option']))
                    {
                        foreach($_POST['option'] as $selected)
                        {
                            array_push($_SESSION['option'], $selected);
                        }
                    }
  
            }
              
        //server stuff
        $servername = getenv('IP');
        $dbPort = 3306; 
        $database = "Vidya";
        $username = getenv('C9_USER');
        $password = "Pooza99";
        $dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
            foreach($_SESSION["option"] as $val)
            {
                //echo '<div > Purchased: '.$val.'</div>';
                
                $sql ="SELECT Game.*
                    FROM Game
                    WHERE Game.gameId = ($val)
                    ";
            //$counter = 0;
            $stmt = $dbConn->prepare($sql);
            $stmt->execute ();
            echo'<table style="width:100%" class = "change">';
         echo'<tr>
                <td> Game Id</td>
                <td> Game Name</td>
                <td> Price</td>
                <td> Total </td>
                
                
              </tr>';
                while($row = $stmt -> fetch())
                {   
           
                   // echo'<div align = "center"> Game Id: '.$row['gameId'].' Game Name: '.$row['gameName'].' Price: '.$row['price'].'</div>';
                    $total  = $total + $row['price'];
                    //echo'<div align = "center">'. 'Total: '.$total.'</div>';
                    
                      echo'<tr>';
                      echo'<td>'.$row['gameId'].'</td>';
                      echo'<td>'.$row['gameName'].'</td>';
                      echo'<td>'.$row['price'].'</td>';
                      echo'<td>'.$total.'</td>';
                      echo' </tr>';
                    
            
                }
                
                echo'</table>';
                
        
          
            }
         
         
        }
  
       

if(isset($_POST['clear']))
       {
        session_unset($_SESSION['option']);
        session_destroy();
        
        
       }
  
?>

      
    <div align = "center">
      <form action="addToCart.php" method="POST">
            
            
                <h2>Select your option: </h2>
                <select multiple name="option[]">
                  <?php
                  
       // Set the Cloud 9 MySQL related information...this is set in stone by C9!
$servername = getenv('IP');
$dbPort = 3306;

// Which database (the name of the database in phpMyAdmin)
$database = "Vidya";

// My user information...I could have prompted for password, as well, or stored in the
// environment, or, or, or (all in the name of better security)
$username = getenv('C9_USER');
$password = "Pooza99";

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
           
           echo'<option value='.$row['gameId'].'>'.'<font color = "white">'.$row['gameName'].'</font></option>';
         
            
        }
        echo'<br></br>';
        echo'<input type="submit" name="submit" value="Add To Shopping Cart"/><input type="submit" name="clear" value="Clear All"/>';
      
                  ?>
                    
                   
                </select>
  </form>
  </div>
      
      
      
<?php
    //HERE WE HAVE THE DISPLAY FUNCTIONS AND HOW IT DECIDES WHAT DO DISPLAY
    if(isset($_POST['mat']))
        dispByMat();
    else if(isset($_POST['rat']))
        dispByRating();
    else if(isset($_POST['con']))
        dispByConsole();
    else
    {
        //echo 'I really dont know how you got to this page! But Im going to display by Price!!';
        dispByPrice();
    }
     
    function dispByConsole()
    {   
       
        echo '<h1 align = "center" >Games displayed by Console</h1>
        <table align = "center">
        <tr>
            <td colspan="5" >Click a Game to see its description!</td>
        </tr>';
        
        echo '<img src="https://www.cyberpowerpc.com/images/cs/enthoominixl/01_220.png" style="float:left" height="200" width="200">';
        echo '<img src="http://target.scene7.com/is/image/Target/52052007_Alt05?wid=520&hei=520&fmt=pjpeg" style="float:right" height="200" width="200">';
        
        echo '<img src="http://1.bp.blogspot.com/-5GXVLdiLU_0/VlSRToyikEI/AAAAAAAARi8/4CjHSqdQRHg/s640/Sony%2BPS3.PNG" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="http://compass.xbox.com/assets/74/ba/74ba692a-e4f1-4195-af2a-e3c1a2f3dd3b.jpg?n=promo-xbox-360-cle-facebook-share-preview.jpg" style="float:right" height="200" width="200">';
        
        echo '<img src="https://media.playstation.com/is/image/SCEA/playstation-4-slim-vertical-product-shot-01-us-07sep16?$TwoColumn_Image$" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="http://www.gamestop.com/common/images/lbox/127395b.jpg" style="float:right" height="200" width="200">';
        
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Nintendo-DS-Fat-Blue.png/250px-Nintendo-DS-Fat-Blue.png" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Wii-Console.png/260px-Wii-Console.png" style="float:right" height="200" width="200">';
        
        
        //server stuff
        $servername = getenv('IP');
        $dbPort = 3306; 
        $database = "Vidya";
        $username = getenv('C9_USER');
        $password = "Pooza99";
        $dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
        //select statement
        //we have to select from the game_console and console as well to display both game and console information
    
        $sql = 'SELECT g.*, gc.*, c.*
                FROM Game as g
                INNER JOIN game_console gc
                    ON g.gameId = gc.gameId
                INNER JOIN Console c
                    ON c.consoleId = gc.consoleId
                ORDER BY c.consoleName ASC';
        $stmt = $dbConn->prepare($sql);
        $i = 0;
        $stmt->execute ();
        while ($row = $stmt->fetch())  {
            $i++;
            echo '
                <tr>
                    <td><div class="popup" onclick="myFunction(' . $i . ')">' .  $row['gameId'] . '. ' . $row['gameName'] . ', Released on the ' . $row['consoleName'] . '
                        <span class="popuptext" id="' . $i . '"> Genre: ' . $row['genre'] . ', Released ' . $row['releaseDate'] .  '. Rating: ' . $row['maturity'] .', Metacritic: ' . $row['rating'] . '/100, Price: $' . $row['price'] . '
                        </span>
                    </div> </td>
                </tr>';
        }
        echo '</table>';
        
        
    }
    function dispByRating()
    {
      echo '<h1 align = "center" >Games displayed by Console</h1>
        <table align = "center">
        <tr>
            <td colspan="5" >Click a Game to see its description!</td>
        </tr>';
        
        echo '<img src="https://www.cyberpowerpc.com/images/cs/enthoominixl/01_220.png" style="float:left" height="200" width="200">';
        echo '<img src="http://target.scene7.com/is/image/Target/52052007_Alt05?wid=520&hei=520&fmt=pjpeg" style="float:right" height="200" width="200">';
        
        echo '<img src="http://1.bp.blogspot.com/-5GXVLdiLU_0/VlSRToyikEI/AAAAAAAARi8/4CjHSqdQRHg/s640/Sony%2BPS3.PNG" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="http://compass.xbox.com/assets/74/ba/74ba692a-e4f1-4195-af2a-e3c1a2f3dd3b.jpg?n=promo-xbox-360-cle-facebook-share-preview.jpg" style="float:right" height="200" width="200">';
        
        echo '<img src="https://media.playstation.com/is/image/SCEA/playstation-4-slim-vertical-product-shot-01-us-07sep16?$TwoColumn_Image$" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="http://www.gamestop.com/common/images/lbox/127395b.jpg" style="float:right" height="200" width="200">';
        
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Nintendo-DS-Fat-Blue.png/250px-Nintendo-DS-Fat-Blue.png" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Wii-Console.png/260px-Wii-Console.png" style="float:right" height="200" width="200">';
        
        
        //server stuff
        $servername = getenv('IP');
        $dbPort = 3306; 
        $database = "Vidya";
        $username = getenv('C9_USER');
        $password = "Pooza99";
        $dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
        //select statement
        //we have to select from the game_console and console as well to display both game and console information
    
        $sql = 'SELECT g.*, gc.*, c.*
                FROM Game as g
                INNER JOIN game_console gc
                    ON g.gameId = gc.gameId
                INNER JOIN Console c
                    ON c.consoleId = gc.consoleId
                ORDER BY g.rating DESC';
        $stmt = $dbConn->prepare($sql);
        $stmt->execute ();
        $i = 0;
        while ($row = $stmt->fetch())  { 
            $i++;
            echo '
                <tr>
                    <td><div class="popup" onclick="myFunction(' . $i . ')">' .  $row['gameId'] . '. ' . $row['gameName'] . ', Released on the ' . $row['consoleName'] . ', Metacritic: ' . $row['rating'] . '/100
                        <span class="popuptext" id="' . $i . '"> Genre: ' . $row['genre'] . ', Released ' . $row['releaseDate'] . '. Rating: ' . $row['maturity'] .', Price: $' . $row['price'] . '
                        
                        </span>
                    </div> </td>
                </tr>';
        }
        echo '</table>';
        
        
    }
    function dispByMat()
    {
        echo '<h1 align = "center" >Games displayed by Console</h1>
        <table align = "center">
        <tr>
            <td colspan="5" >Click a Game to see its description!</td>
        </tr>';
        
        echo '<img src="https://www.cyberpowerpc.com/images/cs/enthoominixl/01_220.png" style="float:left" height="200" width="200">';
        echo '<img src="http://target.scene7.com/is/image/Target/52052007_Alt05?wid=520&hei=520&fmt=pjpeg" style="float:right" height="200" width="200">';
        
        echo '<img src="http://1.bp.blogspot.com/-5GXVLdiLU_0/VlSRToyikEI/AAAAAAAARi8/4CjHSqdQRHg/s640/Sony%2BPS3.PNG" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="http://compass.xbox.com/assets/74/ba/74ba692a-e4f1-4195-af2a-e3c1a2f3dd3b.jpg?n=promo-xbox-360-cle-facebook-share-preview.jpg" style="float:right" height="200" width="200">';
        
        echo '<img src="https://media.playstation.com/is/image/SCEA/playstation-4-slim-vertical-product-shot-01-us-07sep16?$TwoColumn_Image$" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="http://www.gamestop.com/common/images/lbox/127395b.jpg" style="float:right" height="200" width="200">';
        
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Nintendo-DS-Fat-Blue.png/250px-Nintendo-DS-Fat-Blue.png" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Wii-Console.png/260px-Wii-Console.png" style="float:right" height="200" width="200">';
        
        //server stuff
        $servername = getenv('IP');
        $dbPort = 3306; 
        $database = "Vidya";
        $username = getenv('C9_USER');
        $password = "Pooza99";
        $dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
        //select statement
        //we have to select from the game_console and console as well to display both game and console information
    
        $sql = 'SELECT g.*, gc.*, c.*
                FROM Game as g
                INNER JOIN game_console gc
                    ON g.gameId = gc.gameId
                INNER JOIN Console c
                    ON c.consoleId = gc.consoleId
                ORDER BY g.maturity DESC';
        $stmt = $dbConn->prepare($sql);
        $stmt->execute ();
        $i = 0;
        while ($row = $stmt->fetch())  { 
            $i++;
            echo '
                <tr>
                    <td><div class="popup" onclick="myFunction(' . $i . ')">' .  $row['gameId'] . '. ' . $row['gameName'] . ', Rated: ' . $row['maturity']  . ', Released on the ' . $row['consoleName'] . '
                        <span class="popuptext" id="' . $i . '"> Genre: ' . $row['genre'] . ', Released ' . $row['releaseDate'] . '. Metacritic: ' . $row['rating'] . '/100, Price: $' . $row['price'] . '
                        
                        </span>
                    </div> </td>
                </tr>';
        }
        echo '</table>';
        
        
    }
    function dispByPrice()
    {
       echo '<h1 align = "center" >Games displayed by Console</h1>
        <table align = "center">
        <tr>
            <td colspan="5" >Click a Game to see its description!</td>
        </tr>';
        
        echo '<img src="https://www.cyberpowerpc.com/images/cs/enthoominixl/01_220.png" style="float:left" height="200" width="200">';
        echo '<img src="http://target.scene7.com/is/image/Target/52052007_Alt05?wid=520&hei=520&fmt=pjpeg" style="float:right" height="200" width="200">';
        
        echo '<img src="http://1.bp.blogspot.com/-5GXVLdiLU_0/VlSRToyikEI/AAAAAAAARi8/4CjHSqdQRHg/s640/Sony%2BPS3.PNG" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="http://compass.xbox.com/assets/74/ba/74ba692a-e4f1-4195-af2a-e3c1a2f3dd3b.jpg?n=promo-xbox-360-cle-facebook-share-preview.jpg" style="float:right" height="200" width="200">';
        
        echo '<img src="https://media.playstation.com/is/image/SCEA/playstation-4-slim-vertical-product-shot-01-us-07sep16?$TwoColumn_Image$" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="http://www.gamestop.com/common/images/lbox/127395b.jpg" style="float:right" height="200" width="200">';
        
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Nintendo-DS-Fat-Blue.png/250px-Nintendo-DS-Fat-Blue.png" style="float:left;clear:both" height="200" width="200">';
        echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Wii-Console.png/260px-Wii-Console.png" style="float:right" height="200" width="200">';
        
        
        //server stuff
        $servername = getenv('IP');
        $dbPort = 3306; 
        $database = "Vidya";
        $username = getenv('C9_USER');
        $password = "Pooza99";
        $dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        
        //select statement
        //we have to select from the game_console and console as well to display both game and console information

        $sql = 'SELECT g.*, gc.*, c.*
                FROM Game as g
                INNER JOIN game_console gc
                    ON g.gameId = gc.gameId
                INNER JOIN Console c
                    ON c.consoleId = gc.consoleId
                ORDER BY g.price ASC';
        $stmt = $dbConn->prepare($sql);
        $stmt->execute ();
        $i = 0;
        while ($row = $stmt->fetch())  { 
            $i++;
            echo '
                <tr>
                    <td><div class="popup" onclick="myFunction(' . $i . ')">' .  $row['gameId'] . '. ' . $row['gameName'] . ', Released on the ' . $row['consoleName'] . ', $ ' . $row['price']  . '
                        <span class="popuptext" id="' . $i . '"> Genre: ' . $row['genre'] . ', Released ' . $row['releaseDate'] . '. Rating: ' . $row['maturity'] . ' Metacritic: ' . $row['rating'] . '/100
                        
                        </span>
                    </div> </td>
                </tr>';
        }
        echo '</table>';
        
        
    }
?>


   
    
    
    <div>
         
    <h1><a href = "storeFront.php">Go Back To Main Page</a></h1><!--- This Would have to be going back to the main page -->
    </div>
    
    <script>
        // When the user clicks on div, open the popup
        function myFunction($i) {
            var popup = document.getElementById($i);
            popup.classList.toggle("show");
        }
    </script>
    
    
  </body>
</html>



<!--//session_start();-->
<!--//$wherein = implode(',',$_SESSION['cart']);-->
 
<!--       // Set the Cloud 9 MySQL related information...this is set in stone by C9!-->
<!--$servername = getenv('IP');-->
<!--$dbPort = 3306;-->

<!--// Which database (the name of the database in phpMyAdmin)-->
<!--$database = "Vidya";-->

<!--// My user information...I could have prompted for password, as well, or stored in the-->
<!--// environment, or, or, or (all in the name of better security)-->
<!--$username = getenv('C9_USER');-->
<!--$password = "Pooza99";-->

<!--// Establish the connection and then alter how we are tracking errors (look those keywords up)-->
<!--$dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);-->
<!--$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); -->

<!--        $sql ="SELECT Game.*-->
<!--                FROM Game-->
<!--                ";-->

<!--        $stmt = $dbConn->prepare($sql);-->
<!--        $stmt->execute ();-->
<!--     echo'<table style="width:100%" >';-->
<!--         echo'<tr>-->
              
<!--                <td> Game ID</td>-->
<!--                <td> Game Name</td>-->
<!--                <td> Maturity</td>-->
<!--                <td> Genre</td>-->
<!--                <td> Rating</td>-->
                
                
<!--              </tr>';-->
        
<!--        while($row = $stmt -> fetch())-->
<!--        {   -->
           
<!--            echo'<tr>';-->
<!--            echo'<td>'.$row['gameId'].'</td>';-->
<!--             echo'<td>'.$row['gameName'].'</td>';-->
<!--            echo'<td>'.$row['maturity'].'</td>';-->
<!--            echo'<td>'.$row['genre'].'</td>';-->
<!--            echo'<td>'.$row['rating'].'</td>';-->
<!--            echo' </tr>';-->
            
<!--        }-->
<!--         echo'</table>';-->
        