<?php
//This is the vehicle controller. 

//Start session 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the Vehicles Model.
require_once '../model/vehicles-model.php';
// Get the Functions Library
require_once '../library/functions.php';


// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

//$action is a variable that we will use to store the type of content being requested.
//We use the filter_input() function to sift the content to eliminate code that could do the web site harm (read more on php.net about the filter_input funtion).
//We check the POST object (input from forms) and the GET object (input from links) to see if there is a "name - value pair (aka key - value pair) where the key is the word "action". If such a combination is found, the value is stored in the $action variable.
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

//Build a dropdown menu
//$classificationList = '<select id="classification" name="classification">';
//$classificationList .= '<option value="" selected>--Select Classification--</option>';
//foreach ($classifications as $classification) {
//  $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
//}
//$classificationList .= '</select>';

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
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classification', FILTER_SANITIZE_NUMBER_INT));

        //Check with external functions
        $invStock = checkStock($invStock);

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
        //Get value of second name - value pair
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        //Get info for that vehicle
        $invInfo = getInvItemInfo($invId);
        //Check if there is any data, if not show error message
        if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
        }
        //Call view that allows data to be displayed for updating
        include '../view/vehicle-update.php';
        exit;
        break;
    
    
    case 'updateVehicle':
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        //Check with external functions
        $invStock = checkStock($invStock);

        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
            $message = '<p>Please complete all information for the new item! Double check the classification of the item.</p><br>';
            include '../view/vehicle-update.php';
            exit; 
        }

        // Send the data to the model
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

        // Check and report the result
        if($updateResult === 1){
            $message = "<p>$invMake $invModel has been successfuly updated.</p><br>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Sorry, the vehicle has not been updated. Please try again.</p><br>";
            include '../view/vehicle-update.php';
            exit;
        }

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
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);


        // Send the data to the model
        $deleteResult = deleteVehicle($invId);

        // Check and report the result
        if($deleteResult){
            $message = "<p>$invMake $invModel has been successfuly deleted.</p><br>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Sorry, the vehicle has not been deleted. Please try again.</p><br>";
            include '../view/vehicle-delete.php';
            exit;
        }
        break;

    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
        $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
        $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include '../view/classification.php';
        break;

    case 'vehicledetail':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $invModel = filter_input(INPUT_GET, 'invModel', FILTER_SANITIZE_STRING);
        $vehicleDetails = getVehicleDetails($invId);
        if(!count($vehicleDetails)){
        $message = "<p class='notice'>Sorry, $invModel could not be found.</p>";
        } else {
        $vehicleDetailsDisplay = buildVehicleDetailsDisplay($vehicleDetails);
        }
        include '../view/vehicle-detail.php';
        break;

    default:
        //Call buildClassificationList function to create a select list to be displayed in the VM view.
        $classificationList = buildClassificationList($classifications);

       include '../view/vehicle-man.php';
       break;
   }

?>