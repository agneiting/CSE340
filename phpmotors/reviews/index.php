<?php
//This is the reviews controller. 

//Start session 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the reviews model
require_once '../model/reviews-model.php';
// Get the Functions Library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);



//Add a new review

//Handle the review update

//Handle the review deletion

//default that will deliver the admin view if the client is logged in or the php motors home view if not


//The switch control structure examines the $action variable, to see what it's value is.
switch ($action){
    case 'modreview':
        //Get value of second name - value pair
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        //Call view that allows data to be displayed for updating
        include '../view/review-update.php';
        exit;
        break;

    case 'deletereview':
        //Get value of second name - value pair
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        //Call view that confirms review deletion.
        include '../view/review-delete.php';
        exit;
        break;

    default:
        //If logged in
        if ($_SESSION['loggedin'] = TRUE) {
        include '../view/admin.php';
    } else {
        //If not logged in
        include '../view/home.php';}
    break;
     
   }

unset($_SESSION['message']);

?>