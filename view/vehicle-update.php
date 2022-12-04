<?php
if(isset($_SESSION) && ($_SESSION['clientData']['clientLevel'] <2 )) {
    header('Location: /phpmotors/index.php');
}





    $classificationList = '<label for="classificationId">Classification:</label><br><select name="classificationId" id="classificationId">';
    foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
                    $classificationList .= ' selected ';
        }
    }elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
         $classificationList .= ' selected ';
        }
       }
    $classificationList .=">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?><!DOCTYPE html>
<html lang="en-US">
    <head>
        <!-- I will be splitting up the css files after Enrichment 5 because the current is getting to long. -->
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/mobile.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/inventoryDisplay.css" type="text/css" media="screen">
        <link rel="stylesheet" href="/phpmotors/css/nav.css" type="text/css" media="screen">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	 echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
        
    </head>
    <body>
        <header>
           <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>

        <nav class="nav-container">

            <?php echo $navList; ?>
       
        </nav>
        
        <main>
            <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	            echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
	            echo "Modify$invMake $invModel"; }?></h1>
        
            <form action="/phpmotors/vehicles/index.php" method="POST">
               <p>"All fields are required."</p> 

            <?php   if (isset($message)){
                echo $message;
            }?>
                <?php  
                 echo $classificationList;
                
                ?><br><br>

                <label for="invMake">Make:</label><br>

                <input name="invMake" id="invMake" type="text" required   pattern="^[A-Z][A-Z a-z0-9]{1,30}$" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>

                <label for="invModel" >Model:</label><br>

                <input name="invModel" id="invModel" type="text" required pattern="^[A-Z][A-Z a-z0-9]{1,30}$"   <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>

                <label for="invDescription">Description</label><br>

                <textarea name="invDescription" id="invDescription" rows="5" cols="50" required><?php if(isset($invDescription)){echo "$invDescription";} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br>

                <label for="invImage">Image Path:</label><br>

                <input name="invImage" id="invImage" type="text" placeholder="/phpmotors/images/vehicles/no-image.png" required <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?> ><br>

                <label for="invThumbnail">Thumbnail Path:</label><br>

                <input name="invThumbnail" id="invThumbnail" type="text" placeholder="/phpmotors/images/vehicles/no-image.png" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>><br>

                <label for="invPrice">Price:</label><br>

                <input name="invPrice" id="invPrice" type="number" required <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>><br>

                <label for="invStock">Stock:</label><br>

                <input name="invStock" id="invStock" type="number"  required <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>><br>

                <label for="invColor">Color:</label><br>

                <input name="invColor" id="invColor" type="text"  required pattern="[A-Z][A-Za-z]{2,30}$" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>><br><br>
                

                <input type="submit" name="submit" value="Update Vehicle"><br>
                <input type="hidden" name="action" value="updateVehicle">
                <input type="hidden" name="invId" value="
                    <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                    elseif(isset($invId)){ echo $invId; } ?>
                    ">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>
    </body>
</html>