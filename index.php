<?php

require  'frontend.php';

?>


<!DOCTYPE html>
<html lang ="en">
<head>
  <title>Daniel Hopton</title>
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
  <div class="navwrapper">
    <div class="navitem">
      <a href="#header">ABOUT ME</a>
      <p>Who I am</p>
    </div>
    <div class="navitem">
      <a href="#showcase">PROJECTS</a>
      <p>See my work</p>
    </div>
    <div class="navitem">
      <a href="#contact">CONTACT INFO</a>
      <p>Get in touch</p>
    </div>
  </div>
</nav>
<span class="anchor" id="header"></span>
<header>
  <div class="headerwrapper">
    <div class="headertext">
        <?php
        echo displayAboutMe();
        ?>
    </div>
    <div class="badges">
        <?php
            echo displayBadges();
        ?>
    </div>
  </div>
</header>
<span class="anchor" id="showcase"></span>
<main class="showcase">
  <section class="showcasewrapper">
      <?php
        echo displayProject(2);
      ?>
  </section>
</main>
<footer class="contact" id="contact">
  <div class="contactwrapper">
    <ul>
        <?php
            echo displayContactInfo();
        ?>
    </ul>
  </div>
</footer>
</body>
</html>