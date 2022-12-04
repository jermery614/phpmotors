<?php
// reviews controller

session_start();



// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php'; 
// Get the vehicles model
require_once '../model/vehicles-model.php';
//Get the functions library 
require_once '../library/functions.php';
//Get the upload-model
require_once '../model/uploads-model.php';
//Get the review-model
require_once '../model/reviews-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = getNavMenu($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
}

switch ($action){

    case 'addReview':
 
        $newClientReview = filter_input(INPUT_POST, 'newClientReview', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $clientId= filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $vehicleId = filter_input(INPUT_POST, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);

        // For Testing purposes.
        // echo $clientId; 
        // echo $vehicleId;
        // echo $newClientReview; 

        
        // // check to see it the items are emtpy.
        if(empty($newClientReview)|| empty($clientId)|| empty($vehicleId)) {
            $message = "<p> There are empty fields. Please provide all requried information. Thank you.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        }

        //Insert the review into the Database.
        $reviewOutcome = addReview($newClientReview, $vehicleId, $clientId);

        //Check and report the result of the review addition. 
        if ($reviewOutcome === 1){

            $message = "<p>Thank You! your review has been added.</p>";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        } else {
            $message = "Sorry, something went wrong. Please check and try again. Thank you.";
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;

        }
        break; 










default:
if ($_SESSION['loggedin']){
    include '../view/admin.php';
    exit;
}
header('Location: /index.php/');
exit;
break;





}
?>