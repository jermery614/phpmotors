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
    <title> Log In | PHP Motors</title>
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
            <h1>Login To Your Account</h1>
            <?php
            if (isset($message)){
                echo $message;
            }
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
               }

            ?>
            <form id=loginForm action="/phpmotors/accounts/" method="post">
                <label for="clientEmail">Email:</label>
                <br>
                <input type="email" id="clientEmail" name="clientEmail" placeholder="example: name@mail.com" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
                <br>
                <br>
                <label for="clientPassword">Password:</label>
                <br>
                <input type="password" id="clientPassword" name="clientPassword" placeholder="********" pattern= "(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required >
                <p id="requiredText">(Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.)</p>
                <br>
                <a href="/phpmotors/accounts?action=registration"  id="notMember">Not a member yet? Sign Up Today!</a>
                <br>
                <input type="submit" name="action" id="loginbtn" value="Account Login">
                <input type="hidden" name="action" value="loginClient">
                
                <br><br>
                
                <br>

            </form>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div> <!-- Wrapper ends -->
    
</body>
</html><?php unset($_SESSION['message']); ?>