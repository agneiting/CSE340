<?php
//This is the vehicle controller. 


// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Vehicles Model.
require_once '../model/vehicles-model.php';


// Get the array of classifications
$classifications = getClassifications();


// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

//$action is a variable that we will use to store the type of content being requested.
//We use the filter_input() function to sift the content to eliminate code that could do the web site harm (read more on php.net about the filter_input funtion).
//We check the POST object (input from forms) and the GET object (input from links) to see if there is a "name - value pair (aka key - value pair) where the key is the word "action". If such a combination is found, the value is stored in the $action variable.
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

//Build a dropdown menu
$classificationList = '<select id="classification" name="classification">';
$classificationList .= '<option value="" selected>--Select Classification--</option>';
foreach ($classifications as $classification) {
  $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
}
$classificationList .= '</select>';

//The switch control structure examines the $action variable, to see what it's value is.
switch ($action){
    //Each case statement represents a different process to execute. In this instance the case statement has a meaningless value (e.g. 'something') to check and when it does not match the value of $action it is ignored.
    //However, since the case statement does not execute, the default statement executes and delivers the home.php view.
    //If $action had a value and our one case statement had a matching value, then it would run and the default would be ignored because the "break" statement would end the switch and the control structure would be exited.
    case 'template':
      include '../view/template.php';
      break;
    
    case 'addclass':
        include '../view/add-classification.php';
        break;  

    case 'addvehicle':
        include '../view/add-vehicle.php';
        break;  

    case 'newVehicle':
        // Filter and store the data
        $invMake = filter_input(INPUT_POST, 'invMake');
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');
        $classificationId = filter_input(INPUT_POST, 'classification');

        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = '<p>Please provide information for all empty form fields.</p><br>';
            include '../view/add-vehicle.php';
            exit; 
        }

        // Send the data to the model
        $newInventoryOutcome = newInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        // Check and report the result
        if($newInventoryOutcome === 1){
            $message = "<p>$invMake $invModel has been added to the inventory.</p><br>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Sorry, the vehicle has not added to the inventory. Please try again.</p><br>";
            include '../view/add-vehicle.php';
            exit;
        }
        break; 
        
    case 'newClassification':
        // Filter and store the data
        $classificationName = filter_input(INPUT_POST, 'classificationName');

        // Check for missing data
        if(empty($classificationName)){
            $message = '<p>Please provide a classification.</p><br>';
            include '../view/add-classification.php';
            exit; 
        }

        // Send the data to the model
        $newClassificationOutcome = newClassification($classificationName);

        // Check and report the result
        if($newClassificationOutcome === 1){
            include header('location: /phpmotors/vehicles/index.php');
            exit;
        } else {
            $message = "<p>Sorry, the classification has not added. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;

      default:
       include '../view/vehicle-man.php';
       break;
   }

?>