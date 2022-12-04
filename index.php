<?php

// This is the main controller

session_start();



// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get the Funtions in function.php
require_once 'library/functions.php';


// Get the array of classifications
$classifications = getClassifications();

//Get the array for the Nav List
$navList = getNavMenu($classifications);



$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }


// Check to see if the firstname cookie exist. 
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

}

 switch ($action){
    case 'template':
      include 'view/template.php';
      break;


    default:
     include 'view/home.php';
     break;
   }

?>