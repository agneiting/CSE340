<?php
//This is the main controller. 


// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';


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

//The switch control structure examines the $action variable, to see what it's value is.
switch ($action){
    //Each case statement represents a different process to execute. In this instance the case statement has a meaningless value (e.g. 'something') to check and when it does not match the value of $action it is ignored.
    //However, since the case statement does not execute, the default statement executes and delivers the home.php view.
    //If $action had a value and our one case statement had a matching value, then it would run and the default would be ignored because the "break" statement would end the switch and the control structure would be exited.
    case 'template':
      include 'view/template.php';
      break;
      
      default:
       include 'view/home.php';
       break;
   }

?>