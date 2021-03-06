<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title><?php echo $_GET["invMake"] . " " . $invModel; ?> | PHP Motors, Inc.</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1><?php echo $_GET["invMake"] . " " . $invModel; ?></h1>
        <p><em>Reviews can be found at the bottom of the page.</em></p><br>
        <?php 
            //check for a message and display it if found
            if(isset($message)){echo $message; }
            //display the vehicle detail if it exists
            if(isset($vehicleDetailsDisplay)){echo $vehicleDetailsDisplay;} 
        ?>
        <br>
        <h2>Create Review</h2><br>
        <?php 
            //check for a message and display it if found
            if(isset($message)){echo $message; }

            //If logged in, display the form for entering a review. If not logged in, display text telling them to login and provide a link to deliver the login view.
            if(isset($warning))
            {
                echo $warning;
            }

            if(!isset($_SESSION['loggedin']))
            {
                echo "<p><a href='../view/login.php'>Login</a> required to submit a review.</p>";
            }
            else
            {
                echo buildReviewForm($_SESSION['clientData'], $invId);
            }
            //display the reviews for the vehicle
            echo "<br><h2>Customer Reviews</h2>";
            echo getReviewsByItem($invId); 
            
        ?>

    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>