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
    <title> Register Account | PHP Motors</title>
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
            <h1>Register Your Account</h1>



            <?php
            if (isset($message)){
                echo $message;
            }

            ?>
            <form id=regForm action="/phpmotors/accounts/index.php" method="post">
                <br>
                <label for="clientFirstname" >First Name:</label>
                <br>
                <input type="text" id="clientFirstname" name="clientFirstname" placeholder="example: John" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>> 
                <br><br>
                <label for="clientLastname" >Last Name:</label>
                <br>
                <input type="text" id="clientLastname" name="clientLastname" placeholder="example: Doe" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>>
                <br><br>
                <label for="clientEmail" >Email:</label>
                <br>
                <input type="email" id="clientEmail" name="clientEmail" placeholder="example: name@mail.com" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
                <br><br>
                <label for="clientPassword" >Password:</label>
                <br>
                <input type="password" id="clientPassword" name="clientPassword" placeholder="***********" pattern= "(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required >
                <p id="requiredText">(Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.)</p>
                <br>
                <input type="submit" name="showPassword" id="showPasswordbtn" value="Show Password">
                <input type="submit" name="submit" id="registrationbtn" value="Register">
                <input type="hidden" name="action" value="register">
                <p>All fields are required!</p>
                <br>
                




            </form>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div> <!-- Wrapper ends -->
    
</body>
</html>