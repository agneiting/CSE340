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

//Get action variable from the link
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

//The switch control structure examines the $action variable, to see what it's value is.
switch ($action){
    case 'addreview':
        // Filter and store the data
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        // Check for missing data
        if(empty($reviewText)){
            $message = '<p>Please add review content before submitting.</p><br>';
            include '../view/vehicle-detail.php';
            exit; 
        }

        // Send the data to the model
        $insertReviewOutcome = insertReview($reviewText, $invId, $clientId);

        // Check and report the result
        if($insertReviewOutcome === 1){
            $message = "<p>Your review has been added.</p><br>";
            include '../view/vehicle-detail.php';
            exit;
        } else {
            $message = "<p>Sorry, the review has not added. Please try again.</p><br>";
            include '../view/vehicle-detail.php';
            exit;
        }
        break; 
        
    
    case 'modreview':
        //Get value of second name - value pair
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewDate = trim(filter_input(INPUT_GET, 'reviewDate', FILTER_SANITIZE_STRING));
        $reviewText = trim(filter_input(INPUT_GET, 'reviewText', FILTER_SANITIZE_STRING));


        //Get info for that vehicle
        $review = getReview($reviewId);
        $_SESSION['reviewId'] = $reviewId;
        //Check if there is any data, if not show error message
        if(count($review)<1){
            $message = 'Sorry, no review information could be found.';
            }
        
        //Call view that allows data to be displayed for updating
        include '../view/review-update.php';
        exit;
        break;

    case 'updatereview':
        $reviewId = $_SESSION['reviewId']; 
        
        // Filter and store the data
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);


        // Check for missing data
        if(empty($reviewText)){
            $message = '<p>Please fill in the Content field.</p><br>';
            include '../view/review-update.php';
            exit; 
        }

        // Send the data to the model
        $updateResult = updateReview($reviewText, $reviewId);

        
        // Check and report the result
        if($updateResult === 1){
            $message = "<p>Review has been successfuly updated.</p><br>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Sorry, your review has not been updated or there was no change to the content. Please try again.</p><br>";
            include '../view/admin.php';
            exit;
        }
        break;

    case 'deletereview':
        //Get value of second name - value pair
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewDate = trim(filter_input(INPUT_GET, 'reviewDate', FILTER_SANITIZE_STRING));
        $reviewText = trim(filter_input(INPUT_GET, 'reviewText', FILTER_SANITIZE_STRING));

        //Get info for that vehicle
        $review = getReview($reviewId);
        
        //Check if there is any data, if not show error message
        if(count($review)<1){
            $message = 'Sorry, no review information could be found.';
            }        
        include '../view/review-delete.php';
        exit;
        break;

    case 'deleteforever':
        // Filter and store the data
        $reviewId = trim(filter_input(INPUT_POST, 'reviewid', FILTER_SANITIZE_STRING));

        // Send the data to the model
        $deleteResult = deleteReview($reviewId);

        // Check and report the result
        if($deleteResult){
            $message = "<p>Review has been successfuly deleted.</p><br>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Sorry, the review has not been deleted. Please try again.</p><br>";
            include '../view/review-delete.php';
            exit;
        }
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
unset($_SESSION['reviewId']);

?>