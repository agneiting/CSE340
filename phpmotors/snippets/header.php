     
        <img src="/phpmotors/images/site/logo.png" alt="php motors logo">
        <?php
                if(isset($cookieFirstname)){
                echo "<span id='cookie'>Welcome, $cookieFirstname</span>";
                } 
        ?>
        <a href="/phpmotors/accounts/index.php?action=login" title="">My Account</a>

