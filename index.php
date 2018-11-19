<?php

require  'frontend.php';
require 'edit/cms_functions.php';

$db = getDBConnection();
$stmt = $db->prepare('SELECT `title`,`type`,`desc`,`image`,`link` FROM `projects`');
$stmt->execute();
$projects = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <title>Daniel Hopton</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/carousel.css">
</head>
<body>
<nav>
    <div class="navwrapper">
        <div class="navitem collapsenavitem">
            <a href="#header">ABOUT ME</a>
            <p>Who I am</p>
        </div>
        <div class="navitem shortnavitem">
            <a href="#header">ABOUT</a>
        </div>
        <div class="navitem">
            <a href="#showcase">PROJECTS</a>
            <p>See my work</p>
        </div>
        <div class="navitem collapsenavitem">
            <a href="#contact">CONTACT INFO</a>
            <p>Get in touch</p>
        </div>
        <div class="navitem shortnavitem">
            <a href="#contact">CONTACT</a>
        </div>
    </div>
</nav>
<span class="anchor" id="header"></span>
<header>
    <div class="headerwrapper">
        <div class="headertext">
            <?php
            echo displayAboutMe($db);
            ?>
        </div>
        <div class="badges">
            <?php
            echo displayBadges($db);
            ?>
        </div>
    </div>
</header>
<span class="anchor" id="showcase"></span>
<main class="showcase">
    <section class="showcasewrapper">
        <?php
            echo getProjectTexts($projects);
        ?>
        <div class="showcaseviewer">
            <div class="carouselrow">
                <?php
                    echo getProjectImages($projects);
                ?>
            </div>
            <div class="carouselbuttons">
                <button id="carouselprev" class="prev">&lt;</button>
                <button id="carouselnext" class="next">&gt;</button>
            </div>
           <?php echo getProjectLinks($projects);?>
        </div>
    </section>
</main>
<footer class="contact" id="contact">
    <div class="contactwrapper">
        <ul>
            <?php
            echo displayContactInfo($db);
            ?>
        </ul>
    </div>
</footer>
<script src="js/carousel.js" defer></script>
</body>
</html>