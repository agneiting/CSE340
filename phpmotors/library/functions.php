<?php
// Get the database connection file
//require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
//require_once '../model/main-model.php';
// Get the Vehicles Model.
//require_once '../model/vehicles-model.php';


// Build a navigation bar using the $classifications array
function buildNav($carclassifications) {
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($carclassifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
        .urlencode($classification['classificationName']).
        "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

//Check the value of the $clientEmail variable, after having been sanitized, to see if it "looks" like a valid email address.
function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;    
}

//Check that the password meets the format requirement that we added to our HTML form: 
//at least 8 characters, at least 1 capital letter, at least 1 number and at least 1 special character.
function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);    
}

//Check that value of $invPrice is a number
function checkStock($invStock) {
    $valStock = filter_var($invStock, FILTER_VALIDATE_INT);
    return $valStock;    
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

//Function that will build a display of vehicles within an unordered list
function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $price = "$" . number_format($vehicle["invPrice"]);

     $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles/index.php?action=vehicledetail&invId=".urlencode($vehicle['invId'])."&invModel=".urlencode($vehicle['invModel'])."&invMake=".urlencode($vehicle['invMake'])."'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
     $dv .= '<hr>';
     $dv .= "<a href='/phpmotors/vehicles/index.php?action=vehicledetail&invId=".urlencode($vehicle['invId'])."&invModel=".urlencode($vehicle['invModel'])."&invMake=".urlencode($vehicle['invMake'])."'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     $dv .= "<span>$price</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
   }

//Function that will build a display of details for a vehicle within an unordered list
   function buildVehicleDetailsDisplay($vehicleDetails) {
    $dv = '<ul id="vd-display">';
    foreach ($vehicleDetails as $vehicleDetail) {
     $price = "Price: $" . number_format($vehicleDetail["invPrice"]);

     $dv .= '<li>';
     $dv .= "<img class='item1' src='$vehicleDetail[invImage]' alt='Image of $vehicleDetail[invMake] $vehicleDetail[invModel] on phpmotors.com'>";
     $dv .= "<h2 class='item2'>$vehicleDetail[invMake] $vehicleDetail[invModel] Details</h2>";
     $dv .= "<span class='item3' id='vd-display-price'>$price</span>";
     $dv .= "<p class='item4'>$vehicleDetail[invDescription]</p>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;    
   }
?>