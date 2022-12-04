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
    <title>Home | PHP Motors</title>
</head>
<body>
    <div id="wrapper">
        <header>
            
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
        
        </header>


        
        <nav class="nav-container">

            <?php echo $navList; ?>
       
        </nav>
    


        <main id="mainTag">
            <h1 id="welcomsmsg">Welcome to PHP Motors!</h1>
            <div>
                <section class="attributes" id="deloreandescip">
                    <h2>DMC Delorean</h2>
                    <p>3 Cup holders</p>
                    <p>Superman doors</p>
                    <p>Fuzzy dice!!!</p>
                    <input type="image" src="/phpmotors/images/site/own_today.png" alt= "Own it, today button" id = "purchase">

                </section>
                <picture >
                    <img src="/phpmotors/images/vehicles/delorean.jpg" alt="delorean" id ="deloreanpic">
                </picture>
                
                <div class="grid-container">

                <div class="upgrades">
                        <h2 id="reviewheader">DMC Delorean Reviews</h2>
                            <ul>
                                <li class="review" id="item1">"So fast its almost like traveling in time." (4/5)</li>
                                <li class="review" id="item2">"Coolest ride on the road." (4/5)</li>
                                <li class="review" id="item3">"I'm feeling Marty McFly!" (5/5)</li>
                                <li class="review" id="item4">"The most futuristic ride of our day." (4.5/5)</li>
                                <li class="review" id="item5">"80's livin and I love it!" (5/5)</li>
                            </ul>
                        </div>
                  
                        <div class="upgrades">
                            <h2 id="upgradeheader">Delorean Upgrades</h2>
                        </div>
                        <div class="upgrades">
                            <img src = "/phpmotors/images/upgrades/flux-cap.png" alt = "Flux Capacitor" >
                        </div>
                        <div  class="upgrades">
                            <a href = "#" id="fluxlink">Flux Capacitor</a>
                        </div>
                        <div class="upgrades">
                            <img src = "/phpmotors/images/upgrades/flame.jpg"  alt ="Flame Decals" >
                        </div>
                        <div  class="upgrades">
                            <a href = "#" >Flame Decals</a>
                        </div>
                        <div class="upgrades">
                            <img src = "/phpmotors/images/upgrades/bumper_sticker.jpg" alt = "Bumper Sticker">
                            
                        </div>
                        <div  class="upgrades">
                            <a href = "#" >Bumper Sticker</a>
                        </div>
                        <div class="upgrades">
                            <img src = "/phpmotors/images/upgrades/hub-cap.jpg" alt = "Hub Caps" >
                            
                        </div>
                        <div  class="upgrades">
                            <a href = "#" >Hub Caps</a>
                        </div> 
                        
                </div>
            
                
            </div>
        </main>


        
        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div> <!-- Wrapper ends -->
    
</body>
</html>