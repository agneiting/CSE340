<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title>Registration | PHP Motors</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1>Registration</h1>
        
        <?php
        if (isset($message)) {
        echo $message;
        }
        ?>
        
        <form action="/phpmotors/accounts/index.php" method="post">
            <label for="clientFirstname">First Name:</label>
            <br>

            <input type="text" name="clientFirstname" id="clientFirstname">
            <br>

            <label for="clientLastname">Last Name:</label>
            <br>

            <input type="text" name="clientLastname" id="clientLastname">
            <br>

            <label for="clientEmail">Email:</label>
            <br>

            <input type="text" name="clientEmail" id="clientEmail">
            <br>

            <label for="clientPassword">Password:</label>
            <br>

            <input type="text" name="clientPassword" id="clientPassword">
            <br>
             
            <input type="submit" name="submit" id="regbtn" value="Register">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="register">   
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>