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
            /* Popup container - can be anything you want */
            .popup {
                position: relative;
                display: inline-block;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            
            /* The actual popup */
            .popup .popuptext {
                visibility: hidden;
                width: 160px;
                background-color: #555;
                color: #fff;
                text-align: center;
                border-radius: 6px;
                padding: 8px 0;
                position: absolute;
                z-index: 1;
                bottom: 125%;
                left: 50%;
                margin-left: -80px;
            }
            
            /* Popup arrow */
            .popup .popuptext::after {
                content: "";
                position: absolute;
                top: 100%;
                left: 50%;
                margin-left: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: #555 transparent transparent transparent;
            }
            
            /* Toggle this class - hide and show the popup */
            .popup .show {
                visibility: visible;
                -webkit-animation: fadeIn 1s;
                animation: fadeIn 1s;
            }
            
            /* Add animation (fade in the popup) */
            @-webkit-keyframes fadeIn {
                from {opacity: 0;} 
                to {opacity: 1;}
            }
            
            @keyframes fadeIn {
                from {opacity: 0;}
                to {opacity:1 ;}
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
                <td colspan="5" >Click a Game to see its description!</td>
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
            $sql = 'SELECT Game.*, game_console.*, Console.*
                    FROM Game
                    INNER JOIN game_console gc
                        ON Game.gameId = gc.gameId
                    INNER JOIN Console c
                        ON c.consoleId = gc.consoleId';
            if(isset($_POST["mat"])){
                $sql .= ' ORDER BY Game.maturity ASC';
                echo 'MATURITY RATING </h1>';
            }
            else if(isset($_POST["con"]))
            {
                
                $sql .= ' ORDER BY c.consoleName ASC';
                echo 'CONSOLE NAME</h1>';
            }
            else
            {
                $sql .= ' ORDER BY Game.rating DESC';
                echo 'GAME RATING </h1>';
            }
            $stmt = $dbConn->prepare($sql);
            $stmt->execute ();
            while ($row = $stmt->fetch())  { 
                echo "<br />";
                $stars = "";
                $i = $row['rating'];
                while($i > 0)
                {
                    if($i < 1 && $i > 0)
                        $stars .= '½';
                    else
                        $stars .= '★';
                    $i--;
                }
                //WE THEN NEED TO ORGANIZE THIS TO FIT OUR GAME INFORMATION, AND DEPENDING ON WHICH THE USER SELECTED IT WOULD SORT BASED ON THAT
                echo '
                    <tr>
                        <td><div class="popup" onclick="myFunction()">' .  $row['gameId'] . '. ' . $row['gameName'] . ', Maturity: ' . $row['maturity']  . ', On the ' . $row['consoleName']  . '  Rated: ' . $stars . '
                            <span class="popuptext" id="myPopup"> Genre: ' . $row['genre'] . ', Released on ' . $row['releaseDate'] . '
                            
                            </span>
                        </div> </td>
                    </tr>';
            }
            echo '</table>';
            
            
        }  
        
        ?>
        <script>
            // When the user clicks on div, open the popup
            function myFunction() {
                var popup = document.getElementById("myPopup");
                popup.classList.toggle("show");
            }
        </script>
    </body>
</html>