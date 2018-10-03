<?php

require ('cms_functions.php');
updateAbout($_POST);
header('Location: about.php?msg=1');

?>