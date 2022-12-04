<?php

if(isset($_SESSION) && ($_SESSION['clientData']['clientLevel'] <2 )) {
    header('Location: /phpmotors/index.php');
}
if (isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
}


?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/mobile.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/inventoryDisplay.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/nav.css" type="text/css" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vehicle Management | PHP Motors</title>
        
        
</head>
    <body>
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        <nav class="nav-container">

            <?php echo $navList; ?>
       
        </nav>
        
        <main>
            <h1>Vehicle Management</h1>
            <?php
                
            if (isset($_GET['message'])){
                echo $_GET['message'];
            }
            ?>
            <ul id="vidMan">
                <li><a href="/phpmotors/vehicles?action=add-classification" title="Add a classification">Add Classification</a></li>
                <li><a href="/phpmotors/vehicles?action=add-vehicle" title="Add a vehicle">Add Vehicle</a></li>
                
            </ul>






            <?php
            if (isset($message)) { 
            echo $message; 
            } 
            if (isset($classificationList)) { 
            echo '<h2>Vehicles By Classification</h2>'; 
            echo '<p>Choose a classification to see those vehicles</p>'; 
            echo $classificationList; 
            }
            ?>

            <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay"></table>

        </main><br><br><br><br>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
        <script src="../js/inventory.js"></script>
    </body>
</html><?php unset($_SESSION['message']); ?>


