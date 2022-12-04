<?php
if(isset($_SESSION) && ($_SESSION['clientData']['clientLevel'] <2 )) {
    header('Location: /phpmotors/index.php');
}

?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <!-- I will be splitting up the css files after Enrichment 5 because the current is getting to long. -->
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/mobile.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/nav.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/inventoryDisplay.css" type="text/css" media="screen">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title></title>
        
    </head>
    <body>
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>

        <nav class="nav-container">

            <?php echo $navList; ?>
       
        </nav>
        
        <main>
            <h1><?php if(isset($invInfo['invMake'])){ echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
        
            <form action="/phpmotors/vehicles/index.php" method="POST">
               <p>Please Confirm Vehicle Deletion. The delete can not be undone.</p> 

            <?php   if (isset($message)){ echo $message;}?>
               

                <label for="invMake">Make:</label><br>

                <input type="text" readonly name="invMake" id="invMake" <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>

                <label for="invModel" >Model:</label><br>

                <input type="text" readonly name="invModel" id="invModel" <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>

                <label for="invDescription">Description</label><br>

                <textarea name="invDescription" readonly id="invDescription"><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea><br>

                

                <input type="submit" name="submit" value="Delete Vehicle"><br>
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>