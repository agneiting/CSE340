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
           if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
           }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post">
            Email:
            <br>
            <input type="email" name="clientEmail" id="clientEmail" required <?php if (isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
            <br>
            Password:
            <br>
            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <br>
            <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
            <br>
            <br>
            <input type="submit" value="Submit">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="login"> 
        </form>
        <br>
        <h2>No Account? <a href="/phpmotors/accounts/index.php?action=registration">Sign-Up</a> </h2>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>