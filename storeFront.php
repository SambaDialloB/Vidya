<!DOCTYPE html>
<html>
    <head>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Linking my CSS -->
         <link rel = "stylesheet" type =" text/css" href = "style.css"/>
         <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
         <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
        <title>Vidya Games</title>
        
    </head>
    
    <body align = "center" class = "changeColor bodyChange">
        RUBRIC
        <br>
        1) Database has at least 3 tables with 40 records (10 points) <br>
        2) Users can filter data using at least three fields (15 points) <br>
        3) Users can sort results (asc,desc) using at least one field (10 points) <br>
        4) Users can click on an item to get further info (10 points) <br>
        5) Users can add items to shopping cart using a Session (10 points) <br>
        6) Users can see the content of the shopping cart (10 points) <br>
        7) The web pages have a nice and consistent look and feel (10 points) <br>
        8) The team used Github for collaboration (10 points) <br>
        9) The team used Trello or a similar tool for project management (10 points) <br>
        10) In a Word document include User Story, Database schema, and mock
        up (5 points) UPLOAD these documents here and ALSO link them from your C9 site  (5 points) <br>
        <h1> Welcome to the Vidya Game story!</h1>
        
        <h2>How would you like to see the games?</h2>
        <form method="post" action="addToCart.php" name="choice">
            <input type="submit" name="mat" value="Maturity!"/>
            <input type="submit" name="con" value="Console!"/>
            <input type="submit" name="rat" value="Rating!"/>
            <a href="addToCart.php"><button type="button" class="btn btn-primary btn-sm activated"><font color= "black" class = "hoverTxt">Checkout</font></button></a>
        </form>
        <hr>
        
        
        
        <?php
        dispByPrice();
        
        
        
        function dispByPrice()
        {
            echo '<h1>Games displayed by Price Ascending</h1>
            <table align = "center">
            <tr>
                <td colspan="5" >Click a Game to see its description!</td>
            </tr>';
            
            
            //server stuff
            $servername = getenv('IP');
            $dbPort = 3306; 
            $database = "Vidya2";
            $username = getenv('C9_USER');
            $password = "";
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
                        <td><div class="popup" onclick="myFunction(' . $i . ')">' .  $row['gameId'] . '. ' . $row['gameName'] . ', $ ' . $row['price']  . '
                            <span class="popuptext" id="' . $i . '"> Genre: ' . $row['genre'] . ', Released ' . $row['releaseDate'] . ' on the ' . $row['consoleName']  . '. Rating: ' . $row['maturity'] . ' Metacritic: ' . $row['rating'] . '/100
                            
                            </span>
                        </div> </td>
                    </tr>';
            }
            echo '</table>';
            
            
        }
        ?>
        <script>
            // When the user clicks on div, open the popup
            function myFunction($i) {
                var popup = document.getElementById($i);
                popup.classList.toggle("show");
            }
        </script>
    </body>
</html>