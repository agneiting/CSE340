     
        <img src="/phpmotors/images/site/logo.png" alt="php motors logo">
        <?php
                if(isset($_SESSION['loggedin'])){
                        echo '<span id=account><a href="/phpmotors/accounts/index.php?action=admin"> Welcome, ' . $_SESSION['clientData']['clientFirstname'] . '</a> | <a href="/phpmotors/accounts/index.php?action=logout" title="">Logout</a></span>';
                } else {
                        echo '<span id=account><a href="/phpmotors/accounts/index.php?action=login" title="">My Account</a></span>';  
                }
        ?>
       

