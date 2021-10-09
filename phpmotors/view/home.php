<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/styles.css">
    <title>Home | PHP Motors</title>
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    </header>
    <nav>
        <?php echo $navList; ?>     
        <!--<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>-->
    </nav>
    <main>
        <h1>Welcome to PHP Motors!</h1>
        <section id="overview">
            <article>
                <h2>DMC Delorean</h2>
                <p>3 Cup holders<br>Superman doors<br> Fuzzy dice!</p>
            </article>
            <img src="/phpmotors/images/delorean.jpg" alt="DMC Delorean">
            <button type="button"><strong>Own Today</strong></button>
        </section>
        <div class="container">
            <section id="reviews">
                <h2>DMC Delorean Reviews</h2>
                <ul>
                    <li>"So fast it's almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                    <li>The most futuristic ride of our day." (4.5/5)</li>
                    <li>80's livin and I love it! (5/5)</li>
                </ul>
            </section>
            <section id="upgrades">
                <h2>Delorean Upgrades</h2>
                <div>
                    <span class="item">
                        <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux capacitor">
                        <a href="">Flux Capacitor</a>
                    </span>
                    <span class="item">
                        <img src="/phpmotors/images/upgrades/flame.jpg" alt="flame decals">
                        <a href="">Flame Decals</a>
                    </span>
                    <span class="item">
                        <img src="/phpmotors/images/upgrades/bumper_sticker.jpg"
                            alt="bumper sticker that says Hello World">
                        <a href="">Bumper Stickers</a>
                    </span>
                    <span class="item">
                        <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="silver hub cap">
                        <a href="">Hub Caps</a>
                    </span>
                </div>
            </section>
</div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>

</html>