<?php

//This is an area where I am working on making the index better for the future. 
// if (isset($_POST['submit'])){}

//This is the vehicle controller.

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


// Get the array of classifications
$classifications = getClassifications();

// Get the array of, or list of classifications

// Get array for navlist
$navList = getNavMenu($classifications);




$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}



switch ($action) {
  case 'add-classification':
    include '../view/add-classification.php';
      
      break;
  case 'add-vehicle':
    include '../view/add-vehicle.php';
      
      break;

//Add Vehicle case
  case 'addVehicle':
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_SPECIAL_CHARS));
    $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invColor = trim(filter_input(INPUT_POST, 'invColor',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $classificationId = trim(filter_input(INPUT_POST,'classificationId', FILTER_SANITIZE_NUMBER_INT));
    // echo "test 1";

    $checkinvMake = checkMake($invMake);
    $checkinvModel = checkMod($invModel);
    $checkinvColor = checkColor($invColor);


    // Checking for missing data
    if (empty($checkinvMake)|| empty($checkinvModel)|| empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($checkinvColor)){
      $message = ' <p> Please provide information for all empty fields.</p>';
      include '../view/add-vehicle.php';
      exit;
     
    } 
    
    //Send the data to the model
    $addVehicleOutcome= regVehicle($invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invColor, $classificationId);
    // echo $addVehicleOutcome;
    //Check and report the result

    if ($addVehicleOutcome == 1) {
      // echo "Hello";
      // $message = "<p> Thanks for adding $invMake $invModel to the database. </p>";
      // include '../view/vehicle-man.php';
      // exit;
      header("location: /phpmotors/vehicles?message=Success! $invMake $invModel added to the database");
      break;

    } else {
      $message = "<p> Sorry, the $invMake $invModel failed to be added to the inventory. Please try again.</p>";
      include '../view/add-vehicle.php';
      exit;
    }
  break;
// Add Classification case
    case 'addClassification':
      // echo 'Hello! This is a test...';
    $addClassification = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $checkClassification = checkClassification($addClassification);


    if (empty($addClassification)){
      $message = "<p> <strong >Please provide the required information for all fields.</strong></p> ";
      include '../view/add-classification.php';
      
      exit;
    } 
    
    if ($checkClassification == 0){
      $message = "<p><strong> $addClassification is not a valid entry.";
      include '../view/add-classification.php';
      exit;
    }


    $regOutcome = regClassification($addClassification);

    if ($regOutcome == 1){
      header("location: /phpmotors/vehicles?message=Success! $addClassification Classification added.");
      break;
    }
  
/* * ********************************** 
* Get vehicles by classificationId 
* Used for starting Update & Delete process 
* ********************************** */ 
case 'getInventoryItems': 
  // Get the classificationId 
  $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
  // Fetch the vehicles by classificationId from the DB 
  $inventoryArray = getInventoryByClassification($classificationId); 
  // Convert the array to a JSON object and send it back 
  echo json_encode($inventoryArray); 
  break;



case 'mod':
  $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
  $invInfo = getInvItemInfo($invId);
  if(count($invInfo)<1){
    $message = 'Sorry, no vehicle information could be found.';
  }
  include '../view/vehicle-update.php';
  exit;
  break;

case 'del':
  $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
  $invInfo = getInvItemInfo($invId);
  if (count($invInfo) < 1) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-delete.php';
    exit;

    break;


case 'deleteVehicle':
  $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  
  $deleteResult = deleteVehicle($invId);
  if ($deleteResult) {
    $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/vehicles/');
    exit;
  } else {
    $message = "<p class='notice'>Error: $invMake $invModel was not
  deleted.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/vehicles/');
    exit;
  }
  break;
  

case 'updateVehicle':
  $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
  $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
  $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
  
  if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
  $message = '<p>Please complete all information to update the item! Double check the classification of the item.</p>';
  include '../view/vehicle-update.php';
  exit;
  }
  $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);
	    if ($updateResult) {
	        $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
	        $_SESSION['message'] = $message;
            header('Location: /phpmotors/vehicles/');
	        exit;
	    } else {
	        $message = "<p class='notice'>Error: $invMake $invModel was not updated.</p>";
	        include '../view/vehicle-update.php';
	        exit;
	    }
	    break;


   



case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vehicles = getVehiclesByClassification($classificationName);
    // $text1 =var_dump($vehicles);
    // echo $text1;
    // exit;
    if(!count($vehicles)){
      $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
    } else {
      $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }
    // echo $vehicleDisplay;
    // exit;
    include '../view/classification.php';
  break;

case 'vehicleInfo':
  $invId = filter_input(INPUT_GET,'vehicleId', FILTER_SANITIZE_NUMBER_INT );
  $invInfo = getInvItemInfo($invId);
  
//Get the vehicle thumbnails
$tnPath = getThumbnails($invId);
$tnList = getTnDetail($tnPath);

//Get the vehicle reviews

// $reviewList = getAllReviews($invId);

// Build the HTML for the review list. 
// $reviewHTML = '<div id="reviews">';
// foreach($reviewList as $review){
//   $reviewHTML .= buildReview($review['clientFirstname'], $review['clientLastname'], $review['reviewDate'], $review['reviewText']);
// }
// $reviewHTML .="</div>";

  // For Testing.
  // $info = var_dump($invInfo);
  // echo $info;
  // exit;
  if (count($invInfo)< 1){
    $message = "<p class='noice'>Sorry, no information to display.</p>";
  } else {
    $vehicleDisplay = buildVehiclesDetailedView($invInfo);
  }
  include '../view/vehicle-detail.php';
  break;


 default: 

    $classificationList = buildClassificationList($classifications);
    include '../view/vehicle-man.php';
    break;
    }
?>