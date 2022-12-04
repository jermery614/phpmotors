<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/mobile.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/inventoryDisplay.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/nav.css" type="text/css" media="screen">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$invInfo[invMake]". " ". "$invInfo[invModel]";?> | PHP Motors</title>
</head>
<body>
    <div id="wrapper" >
        <header>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        </header>

       
        <nav class="nav-container">

            <?php echo $navList; ?>
       
        </nav>
        

        <main id="vehicleDetail">
        <h1><?php echo $invInfo['invMake']." ". $invInfo['invModel']; ?></h1>
         <!-- Checking to see if a message is set -->
        <?php if(isset($message)){echo $message; }?> 
        
            <div id="mainDisplay" ><?php if(isset($vehicleDisplay)){echo $vehicleDisplay;} ?></div>
            <hr id="thumbnailLine">
            <div id="thumbnailList"><?php if(isset($tnList)){echo $tnList; }?></div><br> 
            <?php  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']===true){echo "Hello ". $_SESSION['clientData']['clientFirstname']." here are your reviews.";}?>
            
            <form action="/phpmotors/reviews/index.php" method="POST" <?PHP if (!isset($_SESSION['loggedin'])){echo "hidden";} ?>><br>
            <label>Leave a review:</label>
                <br>
                <textarea id="review" name="newClientReview" rows="4" cols="50" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required></textarea>
                <br>
                <input type="submit" name="submit" id="regbtn" value="Add Review">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="addReview">
                <input type="hidden" name="clientId" <?php echo 'value='.$_SESSION['clientData']['clientId']?>>
                <input type="hidden" name="vehicleId" <?php echo 'value='.$invId?>>                
            </form>


        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div> <!-- Wrapper ends -->
    
</body>
</html>