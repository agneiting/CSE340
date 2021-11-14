<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title>Update Account | PHP Motors</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
        <?php echo $navList; ?>
    </nav>
    <main>
        <h1>Update Account Information</h1>
        
        <?php
        if (isset($accountmessage)) {
        echo $accountmessage;
        }
        ?>

        <form action="/phpmotors/accounts/index.php" method="post">       
            <h2>Account Update</h2>
            <label for="clientFirstname">First Name:</label>
            <br>
            <input type="text" name="clientFirstname" id="clientFirstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} 
                                                                            elseif(isset($clientData['clientFirstname'])) {echo "value='$clientData[clientFirstname]'"; } ?>>
            <br>
            <label for="clientLastname">Last Name:</label>
            <br>
            <input type="text" name="clientLastname" id="clientLastname" required <?php if (isset($clientLastname)){echo "value='$clientLastname'";}  
                                                                            elseif(isset($clientData['clientLastname'])) {echo "value='$clientData[clientLastname]'"; } ?>>
            <br>
            <label for="clientEmail">Email:</label>
            <br>
            <input type="text" name="clientEmail" id="clientEmail" required <?php if (isset($clientEmail)){echo "value='$clientEmail'";}  
                                                                            elseif(isset($clientData['clientEmail'])) {echo "value='$clientData[clientEmail]'"; } ?>>
            <br>
            <br>
            <input type="submit" name="submit" value="Update Account">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="accountupdate"> 
            <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];}  
                                                                            elseif(isset($clientId)){ echo $clientId; } ?>">
        </form>
        <br><br>
        <?php
        if (isset($passwordmessage)) {
        echo $passwordmessage;
        }
        ?>
        <form action="/phpmotors/accounts/index.php" method="post">
            <h2>Change Password</h2>
            <label for="clientPassword">Password:</label>
            <br>
            <span>This will update your current password. Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <br>
            <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required <?php if(isset($invMclientPasswordake)){echo "value='$clientPassword'";} elseif(isset($clientInfo['clientPassword'])) {echo "value='$clientInfo[clientPassword]'"; } ?>> 
            <br>
            <br>
            <input type="submit" name="submit" value="Update Password">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="updatepassword"> 
            <input type="hidden" name="clientId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>
