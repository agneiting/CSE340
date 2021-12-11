<?php
//PHPMotors Reviews Model

//Function that inserts a new review into the reviews table.
function insertReview($reviewText, $invId, $clientId){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, reviewDate, invId, clientId)
        VALUES (:reviewText, :reviewDate, :invId, :clientId)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//Function that gets reviews for a specific inventory item
function getReviewsByItem($invId){
    $db = phpmotorsConnect(); 
    $sql = ' SELECT clientFirstname, clientLastname, reviewText, reviewDate FROM reviews JOIN clients ON reviews.clientId = clients.clientID WHERE invId = :invId ORDER BY reviewDate ASC'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 

    //Build a display of reviews for a vehicle within an unordered list if there are any reviews, if not then show "Be the first to write a review."
    if(!empty($reviews)) {
        $dv = '<ul id="review-display">';
        foreach ($reviews as $review) {
        //Create Screenname for client.
        $screenName = substr($review['clientFirstname'], 0, 1);
        $screenName .= $review['clientLastname'];

        $dv .= '<li class="review">';
        $dv .= "<h3 class='item1'>$screenName</h3>";
        $dv .= "<p class='item2'>$review[reviewText]</p>";
        $dv .= "<p class='item3'><em>$review[reviewDate]</em></p>";
        $dv .= '</li>';
        }
        $dv .= '</ul>'; 
    } else {
        $dv = "<p>Be the first to write a review.</p>";
    }
    return $dv;
}

//Function that gets review written by a specific client
function getReviewsByClient($clientId){
    $db = phpmotorsConnect(); 
    $sql = 'SELECT invMake, invModel, reviewText, reviewDate, reviewId FROM reviews JOIN inventory ON reviews.invId = inventory.invId WHERE clientId = :clientId ORDER BY reviewDate ASC'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 

    if(!empty($reviews)) {
        $dv = '<ul id="review-display">';
        foreach ($reviews as $review) {    

        $dv .= '<li class="review">';
        $dv .= "<h3 class='item1'>$review[invMake] $review[invModel]</h3>";
        $dv .= "<p class='item2'>$review[reviewText]</p>";
        $dv .= "<p class='item3'><em>$review[reviewDate]</em></p>";
        $dv .= "<a href='/phpmotors/reviews/index.php?action=modreview&reviewId=$review[reviewId]&reviewDate=$review[reviewDate]&reviewText=$review[reviewText]' title='Click to modify'>Modify</a><br>";
        $dv .= "<a href='/phpmotors/reviews?action=deletereview&reviewId=$review[reviewId]&reviewDate=$review[reviewDate]&reviewText=$review[reviewText]' title='Click to delete'>Delete</a>";
        $dv .= '</li>';
        }
        $dv .= '</ul>'; 
    } else {
        $dv = "<p>You have not written any reviews yet.</p>";
    }
    return $dv;  
}



//Function that gets a specific review
function getReview($reviewId){
    $db = phpmotorsConnect(); 
    $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $review = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 

    return $review; 
}

//Function that updates a specific review
function updateReview($reviewText, $reviewId){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    //$stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    //$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    //$stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//Function that deletes a specific review
function deleteReview($reviewId){
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}




//Function that display the review form.
function buildReviewForm(&$clientInfo, $invId){

    //Create Screenname for client.
    $screenName = substr($clientInfo['clientFirstname'], 0, 1);
    $screenName .= $clientInfo['clientLastname'];

    $dv = "<form action='/phpmotors/reviews/' method='POST' id='addreview'>";
    $dv .= "<label for='screenName'>Screen Name</label><br>";
    $dv .= "<input type='text' id='screenName' name='screenName' value='$screenName' readonly><br><br>";
    $dv .= "<label for='reviewText'>Review</label><br>";
    $dv .= "<textarea id='reviewText' name='reviewText' form='addreview' required></textarea><br>";
    $dv .= "<input type='hidden' name='clientId' value='$clientInfo[clientId]'>";
    $dv .= "<input type='hidden' name='invId' value='$invId'>";
    $dv .= "<input type='hidden' name='action' value='addreview'>";
    $dv .= "<input type='submit' value='Submit'>";
    $dv .= "</form>";

    return $dv;
}



?>