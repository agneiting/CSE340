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
    <title>Add Classification | PHP Motors</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1>Add Classification</h1>

        <?php
        if (isset($message)) {
        echo $message;
        }
        ?>

        <table id="inventoryDisplay"></table>

        <form action="/phpmotors/vehicles/index.php" method="post">
            <label for="classificationName">Classification Name:</label>
            <br>
            <input type="text" name="classificationName" id="classificationName" maxlength="30" required>
            <br>
            <br>
            <input type="submit" value="Submit">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="newClassification">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>