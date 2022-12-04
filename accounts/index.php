<?php

// Accounts Controller

session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get the accounts model 
require_once '../model/accounts-model.php';
//Get the vehicle model
require_once '../model/vehicles-model.php';
//Get the functions library 
require_once '../library/functions.php';
//Get the reveiws models
require_once '../model/reviews-model.php';



// Get the array of classifications
$classifications = getClassifications();

//Get array for nav list
$navList =getNavMenu($classifications);

   

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 switch ($action){
    case 'registration':
      include '../view/registration.php';
      break;
      
    case 'login': 
      include '../view/login.php';
      break;

    case 'login2':
      include '../view/admin.php';
      break;

    case 'loginClient':
      // echo "hello1";

      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST,'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS ));

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);
      $existingEmail = checkExistingEmail($clientEmail);


      if (!checkExistingEmail($clientEmail)){
        $message = "<p>$clientEmail does not exist. Please try again.</p>";
        include '../view/login.php';
        exit; 

      }

      if(empty($clientEmail)|| empty($clientPassword)){
        $message ='<p>Please provide information for username and password.</p>';
        include '../view/login.php';
        exit;
        
      } 
      // echo $clientPassword;
      // A valid password exists, proceed with the login process
      // Query the client data based on the email address
      $clientData = getClient($clientEmail);
      
      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      
      // If the hashes don't match create an error
      // and return to the login view
      if(!$hashCheck) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
      }
      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;
      // Remove the password from the array
      // the array_pop function removes the last
      // element from an array
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;

      // // //Get the review for he client.
      // $reviewList = getClientReviews($_SESSION['clientData']['clientId']);
      // $reviewHTML .='<ul>';
      // foreach($reviewList as $review){
      //   $reviewHTML .= buildReviewItem($review['reviewDate'], $review['reviewId']); 
      // }
      // $reviewHTML .='</ul>';
      // exit;
      // break;


      // Send them to the admin view
      include '../view/admin.php';
      exit;

    case 'logout':
      session_unset();
      session_destroy();
      if (isset($_COOKIE['firstname'])){
        setcookie('firstname', "", time() -3600);
      }
      
      header('Location: /phpmotors/');

      exit;



    case 'register':
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));


      $existingEmail = checkExistingEmail($clientEmail);

      // Check for existing email address in the table
      // if(empty($existingEmail)){
      //   echo "nothing found";
      //   exit;
      // } else {
      //   echo "Match Found";
      //   exit;
      // }
      if($existingEmail){
      $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
      }
      //Validate Email and Password. 
      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);
      

      // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit;}


      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);  
      // echo "$hashedPassword";
      // Send the data to the model
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
      

      // Check and report the result
      if($regOutcome === 1){
        setcookie('firstname', $clientFirstname, strtotime('+1year'), '/');
        $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
        header('Location: /phpmotors/accounts/?action=login');

        // $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        // include '../view/login.php';
    
        exit;
        } else {
        $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        include '../view/registration.php';
        exit;
      }
 
    case 'accountMod':
      include '../view/client-update.php';
      break; 
    case 'updateAccount': {
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      $checkclientFirstname = checkFirstname($clientFirstname);
      $checkclientLastname = checkLastname($clientLastname);
      // echo $checkclientFirstname;
      // echo $checkclientLastname;

      if (empty($checkclientFirstname)|| (empty($checkclientLastname))){

        $message = '<p>Please provide all required fields for names fields. Each must satrt with a Capital letter.</p>';
        $_SESSION['message']= $message;
        include '../view/client-update.php';
        exit;
      }

      $existingEmail = checkExistingEmail($clientEmail);
      $newEmail = checkEmail($clientEmail);

      if ($existingEmail===1 ){

        $message = "<p class='notice'>$clientEmail already exists, Please enter anew email adress</p>";
        $_SESSION['message'] = $message;
        include '../view/client-update.php';
        exit;
      }
      if(empty($clientFirstname) || empty($clientLastname) || empty($newEmail)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        $_SESSION['message']= $message;
        include '../view/client-update.php';
        exit;}
        // echo $clientFirstname, $clientLastname,$newEmail,$clientId; 

        $updateOutcome = updateClient($clientFirstname, $clientLastname, $newEmail, $clientId);

        $clientInfo = getClientId($clientId);
        array_pop($clientInfo);
        $_SESSION['clientData'] = $clientInfo;

        if($updateOutcome ===1){
          $message = "<p> Information Updated Successfully.</p>";
          $_SESSION['message']= $message;
          header('Location: /phpmotors/accounts/');
          exit;
        } else {

          $message ="<p>Sorry, your information was unsuccessfully Updataed.</p>";
          $_SESSION['message'] = $message;
          header('Location: /phpmotors/accounts/');
          exit;
        }
        


      }

      break;


      case 'updatePassword': {

        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        
        
        $validatePassword = checkPassword($clientPassword);
        
      
        // echo $validatePassword;
        // check if empty
        if($validatePassword ===0){

          $message = "<p>Please enter a valid password. Thank you. </p>";
          $_SESSION['message'] = $message;
          include '../view/client-update.php';
          exit;
        }}  
        
        
        
        $passwordCompare = getClientId($clientId);
        $verifyPassword = password_verify($clientPassword, $passwordCompare['clientPassword']);
        // echo $verifyPassword;
        if(!empty($verifyPassword)){
        //  echo "Hello";
         $message ="<p>Can not update to past or current password</p>";
         $_SESSION['message'] = $message;
         include '../view/client-update.php';
        exit;

          
        } else {

          $message = "<p>Updating your password.</p>";
          $_SESSION['message'] = $message;
          header('Location: /phpmotors/accounts/');
          $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);


          $newPasswordOutcome = updatePassword($hashedPassword, $clientId);

          if($newPasswordOutcome===1){
                    $message="<p>Updating...</p>";
                    $_SESSION['message'] = $message;
                    unset($message);
                  
                    $message ="<p>Password update complete.</p>";
                    $_SESSION['message'] = $message;
                    header('Location: /phpmotors/accounts/');
                    exit;

        }
      }
       
    

      
default:
    include '../view/admin.php';

    break;
     
   }
  
?>