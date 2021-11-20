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
        <?php 
            //check for a message and display it if found
            if(isset($message)){echo $message; }
            //display the vehicle detail if it exists
            if(isset($vehicleDetailsDisplay)){echo $vehicleDetailsDisplay;} 
        ?>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>