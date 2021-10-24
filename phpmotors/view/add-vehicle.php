<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title>Add Vehicle | PHP Motors</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1>Add Vehicle</h1>

        <?php
        if (isset($message)) {
        echo $message;
        }
        ?>

        <form action="/phpmotors/vehicles/index.php" method="post">
            <label for="classification">Classification:</label>
            <br>
            <?php echo $classificationList; ?>
            <br>
            <label for="invMake">Make:</label>
            <br>
            <input type="text" name="invMake" id="invMake">
            <br>
            <label for="invModel">Model:</label>
            <br>
            <input type="text" name="invModel" id="invModel">
            <br>
            <label for="invDescription">Description:</label>
            <br>
            <input type="text" name="invDescription" id="invDescription">
            <br>
            <label for="invImage">Image Path:</label>
            <br>
            <input type="text" name="invImage" id="invImage" value="/images/no-image.png">
            <br>
            <label for="invThumbnail">Thumbnail Path:</label>
            <br>
            <input type="text" name="invThumbnail" id="invThumbnail" value="/images/no-image.png">
            <br>
            <label for="invPrice">Price:</label>
            <br>
            <input type="text" name="invPrice" id="invPrice">
            <br>
            <label for="invStock">Stock:</label>
            <br>
            <input type="text" name="invStock" id="invStock">
            <br>
            <label for="invColor">Color:</label>
            <br>
            <input type="text" name="invColor" id="invColor">
            <br>
            <br>
            <input type="submit" value="Submit">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="newVehicle"> 
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>