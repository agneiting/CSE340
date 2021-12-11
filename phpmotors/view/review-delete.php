<?php 
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title>Delete Review | PHP Motors</title>
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
            Delete Review
        </h1>

        <?php
        if (isset($message)) {
        echo $message;
        }
        ?>

        <form action="/phpmotors/reviews/index.php" method="post">
            <label for="reviewDate">Date:</label>
            <br>
            <input type="text" readonly name="reviewDate" id="reviewDate" <?php if(isset($reviewDate)){echo "value='$reviewDate'";} elseif(isset($review['reviewDate'])) {echo "value='$review[reviewDate]'"; } ?>>
            <br>
            <label for="reviewText">Content:</label>
            <br>
            <input type="text" readonly name="reviewText" id="reviewText" <?php if (isset($reviewText)){echo "value='$reviewText'";} elseif(isset($review['reviewText'])) {echo "value='$review[reviewText]'"; } ?>>
            <br>
            <br>
            <input type="submit" name="submit" value="Delete Review">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="deleteforever"> 
            <input type="hidden" name="invId" value="<?php if(isset($review['reviewId'])){ echo $review['reviewId'];} elseif(isset($reviewId)){ echo $reviewId; } ?>">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>