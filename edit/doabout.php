<?php

require ('cms_functions.php');
if(anyFieldEmpty($_POST)) {
    header('Location: about.php?msg=16');
    exit;
}
updateAbout($_POST);
header('Location: about.php?msg=1');

?>