<?php
if(isset($_SESSION) && ($_SESSION['clientData']['clientLevel'] <2 )) {
    header('Location: /phpmotors/index.php');
}


?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/mobile.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/nav.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/inventoryDisplay.css" type="text/css" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Classification | PHP Motors</title>
        
    </head>
    <body>
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>
        
        <nav class="nav-container">

            <?php echo $navList; ?>
       
        </nav>
       
        <main>
            <h1>Add Classification</h1>

            <div id ="warning">
                <?php if (isset($message)) {
                echo $message;
            } 
            ?></div>
            
            <form action="/phpmotors/vehicles/index.php" method="POST">
                <p >The classification must have two letters minimum, start with a capital letter,</p>
                <p> not to exceed 30 characters, and having no numbers.</p><br><br>

                <label for="classificationName">Classification Name:</label><br>

                <input name="classificationName" id="classificationName" type="text"  required  pattern="[A-Z][A-Za-z]{1,30}$" ><br>

                
                <input type="submit" name="submit" id="addClassificationbtn" value="Add Clasification">
                <input type="hidden" name="action" value="addClassification">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>