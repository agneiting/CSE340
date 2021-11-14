<?php
    //Check for login and level
    if ($_SESSION['clientData']['clientLevel'] < 2) {
        header('location: /phpmotors/');
        exit;
    }



    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
       }

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title>Vehicle Manager | PHP Motors</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1>Vehicle Manager</h1>
        <a href="/phpmotors/vehicles/index.php?action=addclass" title="">Add Classification</a>
        <br>
        <a href="/phpmotors/vehicles/index.php?action=addvehicle" title="">Add Vehicle</a>
        <br><br>


        <?php
            if (isset($message)) { 
            echo $message; 
            } 
            if (isset($classificationList)) { 
            echo '<h2>Vehicles By Classification</h2>'; 
            echo '<p>Choose a classification to see those vehicles</p>'; 
            echo $classificationList; 
            }
        ?>

        <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <br>
        <br>
        <table id="inventoryDisplay"></table>
        <br>
    
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

<script src="/phpmotors/js/inventory.js"></script>

</html>
<?php unset($_SESSION['message']); ?>