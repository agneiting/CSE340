<?php 
    //Check for login and level
    if ($_SESSION['clientData']['clientLevel'] < 2) {
        header('location: /phpmotors/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
            <?php if(isset($invInfo['invMake'])){ 
            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?>
        </h1>

        <?php
        if (isset($message)) {
        echo $message;
        }
        ?>

        <form action="/phpmotors/vehicles/index.php" method="post">
            <label for="invMake">Make:</label>
            <br>
            <input type="text" readonly name="invMake" id="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?>>
            <br>
            <label for="invModel">Model:</label>
            <br>
            <input type="text" readonly name="invModel" id="invModel" <?php if (isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?>>
            <br>
            <label for="invDescription">Description:</label>
            <br>
            <input type="text" readonly name="invDescription" id="invDescription" <?php if (isset($invDescription)){echo "value='$invDescription'";} elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; } ?>>
            <br>
            <br>
            <input type="submit" name="submit" value="Delete Vehicle">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="deleteVehicle"> 
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>