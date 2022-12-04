<?php   
if (!$_SESSION['loggedin']){
    header('Location: /index.php/');
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
    <title>Account Update | PHP Motors</title>
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
            
            <h1>Account Management</h1>
            <?php if (isset($_SESSION['message'])) { echo $_SESSION['message']; } ?>
            <h2>Update Account</h2>
            <form id="updateAccount" action="/phpmotors/accounts/index.php" method="POST">
                <label for="clientFirstname">First Name:</label><br> 
                <input name="clientFirstname" id="clientFirstname" type="text" pattern="(^[A-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required> <br>
                <label for="clientLastname">Last Name:</label><br>
                <input name="clientLastname" id="clientLastname" type="text" pattern="(^[A-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required><br>
                <label for="clientEmail">Email:</label><br>
                <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>

                <button type="submit">Update Info</button>
                <input type="hidden" name="action" value="updateAccount">
                <input type="hidden" name="clientId" value=" <?php if(isset($_SESSION['clientData']['clientId'])){echo "value='".$_SESSION['clientData']['clientId']."'";} ?>">
            </form>

            
            <h2>Change Password</h2>
            <form id= "updatePassword" action="/phpmotors/accounts/index.php" method="POST">
                <p id="password-notice">Passwords must be at least 8 characters and contain at least 1 number, 1 uppercase letter, 1 lowercase letter, and 1 special character.</p>
                <p><strong>Note</strong>: Your original password will be changed.</p><br>
                

                <label for="clientPassword">New Password:</label><br>
                <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>

                <button type="submit">Update Password:</button><br>
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" value=" <?php if(isset($_SESSION['clientData']['clientId'])){echo "value='".$_SESSION['clientData']['clientId']."'";} ?>">
                <input type="hidden" name="clientEmail" value=" <?php if(isset($_SESSION['clientData']['clientEmail'])){echo "value='".$_SESSION['clientData']['clientEmail']."'";} ?>">
            </form>
        </main>

        <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div> <!-- Wrapper ends -->
    
</body>
</html><?php unset($_SESSION['message']); ?>