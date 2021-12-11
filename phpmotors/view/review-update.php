<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title>Update Review | PHP Motors</title>
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
            Update Review
        </h1>

        <?php
        if (isset($message)) {
        echo $message;
        }
        ?>

        <form action="/phpmotors/reviews/index.php" method="post">
            <label for="reviewDate">Date:</label>
            <br>
            <input type="text" name="reviewDate" id="reviewDate"
                <?php if(isset($reviewDate)){echo "value='$reviewDate'";} elseif(isset($review[0]['reviewDate'])) {echo "value='$review[0][reviewDate]'"; } ?> readonly required>
            <br>
            <label for="reviewText">Content:</label>
            <br>
            <input type="text" name="reviewText" id="reviewText" <?php if(isset($reviewText)){echo "value='$reviewText'";} elseif(isset($review['reviewText'])) {echo "value='$review[reviewText]'"; }?> required>
            <br>
            <br>
            <input type="submit" name="submit" value="Update Review">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="updatereview"> 
            <input type="hidden" name="reviewId" value="<?php if(isset($review['reviewId'])){ echo $review['reviewId'];} elseif(isset($reviewId)){ echo $reviewId; } ?>">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>