<?php
if(!isset($_SESSION['loggedin'])){
    header('Location: /phpmotors/');

}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/mobile.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/inventoryDisplay.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/nav.css" type="text/css" media="screen">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin | PHP Motors</title>
</head>
<body>
<div id="wrapper" >
        <header>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>

       
        <nav class="nav-container">

            <?php echo $navList; ?>
       
        </nav>
        

        <main>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>

            <h1><?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']; ?></h1>
            
            <h2 ><i>You are logged in!</i></h2>
            <ul >
                <li><?php echo "First Name: ".$_SESSION['clientData']['clientFirstname']; ?></li>
                <li><?php echo "Last Name: ".$_SESSION['clientData']['clientLastname']; ?></li>
                <li><?php echo "Email: ".$_SESSION['clientData']['clientEmail']; ?></li>
            </ul>
           <?php

           if (isset($_SESSION['loggedin'])){
            // echo "Hello";
            echo "<h2>Account Management</h2>";
            echo "<p> Use this link to  update account information <a href='/phpmotors/accounts/?action=accountMod'>here</a></p>";
            }
           ?>

            <?php
            if (isset($_SESSION['loggedin'])&& ($_SESSION['clientData']['clientLevel']>1)){
                echo "<h3>Inventory Management</h3>";
                echo "<p>Manage your inventory <a href='/phpmotors/vehicles/'>here</a></p>";
            }
            ?>
            
            <h3 id="Welcomeback"><i>Welcome Back!</i></h3>
            

            <!-- <h3>Manage Inventory</h3> -->
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body><?php unset($_SESSION['message']); ?>