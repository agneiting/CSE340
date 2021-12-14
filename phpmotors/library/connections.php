<?php 
// Connection to PHPMotors DB
function phpmotorsConnect(){
    $server = 'localhost';
    $dbname = 'phpmotors';
    $username = 'iClient';
    $password = 'XaaLo5U3vvHppQvH';
    $dsn = 'mysql:host='.$server.';dbname='.$dbname;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    
    // Create the actual connection object and assign it to a variable
    try {
        $link = new PDO($dsn, $username, $password, $options);
        //echo "Hey I can connect!";

        return $link;
    } catch(PDOException $e) {
        header('Location: /phpmotors/view/500.php');
        
        //echo 'Sorry, the connection failed';
        exit;
    }
}

phpmotorsConnect();
?>