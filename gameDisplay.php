<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <style type="text/css">
            .center{
                margin: 0 auto;
                width:90%;
                display:block;
            }    
        </style>
    </head>
    <body>
        
        
        
    
        
        <?php
        dispByPirce();
        // echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
        //displayDesc();
        //display all menu items using ORDER BY, each item will be an anchor tag to the choresponding description of the item
        
        

    
        function dispByPirce()
        {
            echo '
            <table>
            <tr>
                <td colspan="5" >Click an Item to see its description!</td>
            </tr>
            <tr>
                <td>Product Id</td>
                <td>Product Name</td>
                <td>Calories</td>
                <td>Healthy Choice?</td>
                <td>Price</td>
            </tr>';
            
            
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

            echo '<h1>LIST OF ALL GAMES BY ';
            $sql = 'SELECT *
                    FROM Game';
            if(isset($_POST["mat"])){
                $sql .= ' ORDER BY Game.maturity ASC';
                echo 'MATURITY RATING </h1>';
            }
            else if(isset($_POST["con"]))
            {
                
                $sql .= ' ORDER BY price DESC';
                echo ' MAX PRICE </h1>';
            }
            else
            {
                $sql .= ' ORDER BY price ASC';
                echo 'Min Price</h1>';
            }
            $stmt = $dbConn->prepare($sql);
            $stmt->execute ();
            while ($row = $stmt->fetch())  { 
                echo "<br />";
                
                //WE THEN NEED TO ORGANIZE THIS TO FIT OUR GAME INFORMATION, AND DEPENDING ON WHICH THE USER SELECTED IT WOULD SORT BASED ON THAT
                echo '
                    <tr>
                        <td><a href="#' . $row['productId'] . '">' . $row['productId']  .'</a></td>
                        <td><a href="#' . $row['productId'] . '">' . $row['productName']  .'</a></td>
                        <td><a href="#' . $row['productId'] . '">' . $row['calories']  .'</a></td>
                        <td><a href="#' . $row['productId'] . '">' . $row['healthyChoice']  .'</a></td>
                        <td><a href="#' . $row['productId'] . '">' . $row['price']  .'</a></td>
                    </tr>';
                    $i++;
                        
            }
        
            echo '</table>';
        }  
        
                
        function displayDesc()
        {
            
            $servername = getenv('IP');
            $dbPort = 3306; 
            $database = "Otter Express";
            $username = getenv('C9_USER');
            $password = "Pooza99";
            $dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
            $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
           
             $sql = 'SELECT *
                    FROM Product
                    ORDER BY price ASC' ;
            echo $sql;
            $stmt = $dbConn->prepare($sql);
            $stmt->execute();
            
            
             while ($row = $stmt->fetch())  { 
                echo "<br />";
                
                
                echo '  <h2 id="'. $row['productId'] . '">Name:' . $row['productName'] . ' </h2>
                        Product ID: ' . $row['productId'] . '
                        <p> ' . $row['productDesc'] . '</p>';
                        
            }
            
        }
        ?>
    
    </body>
</html>