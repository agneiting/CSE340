<?php
    //Check for login
    if(!$_SESSION['loggedin']){
        include header('location: /phpmotors/index.php');
    }
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title>Admin View | PHP Motors</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1>
            <?php 
                echo "Logged in as " . $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname']; 
            ?>
        </h1>
        
        <?php
           if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
           }
        ?>

        <ul>
            <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li> 
            <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
            <li>Email: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
        </ul>
        <h2>Account Management</h2><br>
        <p>Use this link to update account information.</p>
        <p> <a href="/phpmotors/accounts/index.php?action=modaccount">Update Account Information</a></p>
        <br><br>
        <?php 
                if($_SESSION['clientData']['clientLevel'] > 1) {
                    echo '
                        <h2>Inventory Management</h2><br>
                        <p>Use this link to manage the inventory.</p>
                        <p> <a href="/phpmotors/vehicles/index.php">Vehicle Manager</a></p>';
                }
        ?>
        <br><br>
        <h2>Manage My Reviews</h2>
        <?php 
            //check for a message and display it if found
            if(isset($message)){echo $message; }
            //display the reviews for the vehicle
            $clientId = $_SESSION['clientData']['clientId'];
            echo getReviewsByClient($clientId); 
        ?>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>
