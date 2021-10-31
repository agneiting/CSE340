<?php 
    //Build a dropdown menu
    $classificationList = '<select id="classification" name="classification">';
    $classificationList .= '<option value="" selected>--Select Classification--</option>';
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'";
        if(isset($classificationId)){
            if($classification['classificationId'] === $classificationId){
                    $classificationList .= 'selected';
            }
        }  
        $classificationList .= ">$classification[classificationName]</option>";
    }
    $classificationList .= '</select>'; 
    
?><!DOCTYPE html>
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
            <input type="text" name="invMake" id="invMake" <?php if (isset($invMake)){echo "value='$invMake'";}  ?> required>
            <br>
            <label for="invModel">Model:</label>
            <br>
            <input type="text" name="invModel" id="invModel" <?php if (isset($invModel)){echo "value='$invModel'";}  ?> required>
            <br>
            <label for="invDescription">Description:</label>
            <br>
            <input type="text" name="invDescription" id="invDescription" <?php if (isset($invDescription)){echo "value='$invDescription'";}  ?> required>
            <br>
            <label for="invImage">Image Path:</label>
            <br>
            <input type="text" name="invImage" id="invImage" value="/images/no-image.png" <?php if (isset($invImage)){echo "value='$invImage'";}  ?> required>
            <br>
            <label for="invThumbnail">Thumbnail Path:</label>
            <br>
            <input type="text" name="invThumbnail" id="invThumbnail" value="/images/no-image.png" <?php if (isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> required>
            <br>
            <label for="invPrice">Price:</label>
            <br>
            <input type="text" name="invPrice" id="invPrice" <?php if (isset($invPrice)){echo "value='$invPrice'";}  ?> required>
            <br>
            <label for="invStock">Stock:</label>
            <br>
            <input type="number" name="invStock" id="invStock" <?php if (isset($invStock)){echo "value='$invStock'";}  ?> required>
            <br>
            <label for="invColor">Color:</label>
            <br>
            <input type="text" name="invColor" id="invColor" <?php if (isset($invColor)){echo "value='$invColor'";}  ?> required>
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