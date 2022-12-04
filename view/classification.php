<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/phpmotors/css/styles.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/mobile.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/inventoryDisplay.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/nav.css" type="text/css" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
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
        <h1><?php echo $classificationName; ?> vehicles</h1>
         <!-- Checking to see if a message is set -->
        <?php if(isset($message)){echo $message; }?>
        <!-- Checking to see if the vehicle list exist -->
        <?php if(isset($vehicleDisplay)){echo $vehicleDisplay;} ?>

        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div> <!-- Wrapper ends -->
    
</body>
</html>