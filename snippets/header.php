<div id="top-header" class="header" >
<img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo" id="logo">

<?php
//Note to self: It makes more sense to do it here thant on the other page.
// if(isset($cookieFirstname)){
//  echo "<span id='cookie'>Welcome, $cookieFirstname</span>";
// }

if (isset($_SESSION['loggedin'])){
    if (isset($_SESSION['clientData']['clientFirstname'])){
        $name = $_SESSION['clientData']['clientFirstname'];
        echo "<div id='salutation'><a href= '/phpmotors/accounts/index.php?action=login2' id='salut'>Welcome $name</a> | <a href='/phpmotors/accounts?action=logout' id='logout'>Logout</a></div> ";
    }

    } else {
        echo "<a href='/phpmotors/accounts?action=login' title='Login or Register with PHP Motors' id='acc'>My Account</a>";
    }
    




 ?>

</div>