<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title>Login | PHP Motors</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1>PHP Motors Login</h1>
        <?php
            if (isset($message)) {
            echo $message;
            }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post">
            Email:
            <br>
            <input type="text" name="clientEmail" id="clientEmail" required>
            <br>
            Password:
            <br>
            <input type="text" name="clientPassword" id="clientPassword" required>
            <br>
            <input type="submit" value="Submit">
        </form>
        <h2>No Account? <a href="/phpmotors/accounts/index.php?action=registration">Sign-Up</a> </h2>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>