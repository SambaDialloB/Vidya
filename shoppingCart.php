



<!DOCTYPE html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script>
            // When the user clicks on <div>, open the popup
            function myFunction($val) 
            {
                var popup = document.getElementById($val);
                popup.classList.toggle("show");
            }

        </script>
    </head>
    <body>
<?php
session_start();
$wherein = implode(',',$_SESSION['cart']);
 
       // Set the Cloud 9 MySQL related information...this is set in stone by C9!
$servername = getenv('IP');
$dbPort = 3306;

// Which database (the name of the database in phpMyAdmin)
$database = "Vidya";

// My user information...I could have prompted for password, as well, or stored in the
// environment, or, or, or (all in the name of better security)
$username = getenv('C9_USER');
$password = "";

// Establish the connection and then alter how we are tracking errors (look those keywords up)
$dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        $sql ="SELECT Game.*
                FROM Game
                WHERE Game.gameId IN ($wherein)
                ";

        $stmt = $dbConn->prepare($sql);
        $stmt->execute ();
    
      echo"
        <body>
        <table class = 'table-fill'>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
     
            </tr>
        </thead>
        <tbody>";
        $val = 0;
        while ($row = $stmt->fetch())  
        {
            
                echo "
                <tr>
                    <td>
                        <div onclick = \"myFunction($val)\">
                         ".$row['gameName']."
                        <span id=$val>".$row['gameName']."</span>
                        </div>
                    </td>
                        <td>"."$".$row['maturity']."</td>
                </tr>";
            
                
    
            
                $val = $val+1;
        }
        
        
?>
</body>
<a href = "products.php">Go Back To Main Page</a>
</html>
