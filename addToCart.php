<?php
// Start the session
session_start();
if(empty($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
array_push($_SESSION['cart'],$_GET['id']);
?>
<html>
  <head>
      
  </head>  
  <body>
      <h1 align = "center">Product Was Added To Cart</h1>
      <a style = "text-align:center "href = "shoppingCart.php">View Shopping Cart</a>
    <a href = "products.php">Go Back To Main Page</a><!--- This Would have to be going back to the main page -->
  </body>
</html>