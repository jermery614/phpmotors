<?php


function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}
//Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and 
// at least 1 special character. 

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);

}

function checkClassification($addClassifiction){
    $pattern='/^[A-Z][A-Za-z]{1,30}$/';
   
    return preg_match($pattern, $addClassifiction);
}

function checkMake($invMake){
    $pattern='/^[A-Z][A-Z a-z0-9]{1,30}$/';
    return preg_match($pattern, $invMake);
}

function checkMod($invModel){
    $pattern='/^[A-Z][A-Z a-z0-9]{1,30}$/';
    return preg_match($pattern, $invModel);
}

function checkColor($invColor){
    $pattern='/^[A-Z][A-Z a-z]{2,30}$/';
    return preg_match($pattern, $invColor);
}

function checkFirstname($clientFirstname){
    $pattern = '/(^[A-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/';
    return preg_match($pattern, $clientFirstname);

}

function checkLastname($clientLastname){
    $pattern = '/(^[A-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/';
    return preg_match($pattern, $clientLastname);
}


function getNavMenu($classifications){
    // Build navigation list
  $navList = '<ul>';
  $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';
  return $navList;
}
//build the classification list
function makeClassificationList($classifications){
    $classificationList = '<label for="classificationId">Classification:</label><br><select name="classificationId" id="classificationId">';
    foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]' >$classification[classificationName]</option>";
}
    $classificationList .= '</select>';
    return $classificationList;

}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
   }

function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $vehiclePrice =number_format($vehicle['invPrice']);
     $dv .= '<li>';
     $dv .= "<a href = '/phpmotors/vehicles?action=vehicleInfo&vehicleId=$vehicle[invId]'>";
     $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $dv .= "<span>$$vehiclePrice</span>";
     $dv .= "</a>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv; 
   }

function buildVehiclesDetailedView($vehicle){
    $vehiclePrice = number_format($vehicle['invPrice']);
    $dv ='<div id="vehicle-item-details">';
    $dv .="<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] onphpmotors.com'>";
    $dv .='<div id="details">';
    $dv .="<p id='vehicleNameDesc'>$vehicle[invMake]".' '  . "$vehicle[invModel] Details:</p>";
	$dv .= "<p id='vehicleDesc' >$vehicle[invDescription]</p>";
	$dv .= "<p id='vehicleColor' >Color: $vehicle[invColor]</p>";
	$dv .= "<p id='QTY' >In Stock: $vehicle[invStock]</p>";
    $dv .= "<p id='price'>Price: $$vehiclePrice</p>";
    $dv .= '</div>';
    $dv .= '</div>';
    return $dv;
   }

/* * ********************************
*  Functions for working with images
* ********************************* */


// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
   }

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
   }


// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
   }

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
   }

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends resizeImage function




function getTnDetail($tnList) {
	$id = '';
	foreach ($tnList as $tn) {
		$id .= "<img src='$tn[imgPath]' alt='Thumbnail $tn[imgName] on phpmotors.com'>";
	}
	return $id;
}


// The function builds a block of html for a review with name and date. 
function buildReview($clientFirstName, $clientLastName, $date, $reviewText){
    $htmlText = "<p>";
    $htmlText .= substr($clientFirstName, 0, 1).". ".$clientLastName;
    $timestamp = strtotime($date);
    $htmlText .= "<br>Posted on: ".date('m/d/Y H:i:s', $timestamp);
    $htmlText .= "<br><br>".$reviewText;
    $htmlText .= "</p>";
    return $htmlText;
}

// The function builds a block of html for the review list.
function buildReviewItem($reviewDate, $reviewId) {
    $htmlText = '<li>';
    $timestamp = strtotime($reviewDate);
    $htmlText .= 'Review Created on: '.date('m/d/Y H:i:s', $timestamp);
    $htmlText .= ' <a href = "/reviews/index.php?action=confirmEdit&review='.$reviewId.'">Edit</a>';
    $htmlText .= ' | ';
    $htmlText .= '<a href = "/reviews/index.php?action=confirmDelete&review='.$reviewId.'">Delete</a>';
    $htmlText .= '</li>';
    return $htmlText;
}

?>