<?php

/*
 * Gets a database object to use for database queries. This database's fetch mode is set to FETCH_ASSOC by default.
 *
 * @Return returns the object to use for our given queries.
 */
function getDBConnection() {
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

function displayAboutMe(PDO $db) {
    $stmt = $db->prepare('SELECT `name`,`title`,`desc` FROM `about`');
    $stmt->execute();
    $result = $stmt->fetch();
    $name = '<h1>' . $result['name'] . '</h1>';
    $title = '<h2>' . $result['title'] . '</h2>';
    $desc = '<p>' . $result['desc'] . '</p>';
    return $name . $title . $desc;
}

function displayBadges(PDO $db) {
    $stmt = $db->prepare('SELECT `value` FROM `badges`');
    $stmt->execute();
    $entries = $stmt->fetchAll();
    $output = '';
    foreach ($entries as $entry) {
        $output .= '<i class="' . $entry['value'] . '"></i>';
    }
    return $output;
}

/*
 * Clamps the project ID to an existing project in the database. If the ID is higher than any existing number,
 * we loop back around to the first project ID. If it is lower, we loop back around to the last project ID. If
 * in the event the autoincrement screws up and we have missing numbers we will round to the nearest existing number.
 *
 * @param int The target project ID recieved from the GET string.
 *
 * @return int The corrected ID of the project we will be displaying.
 */
function clampProjectID(PDO $db, int $id, bool $up) {
    $stmt = $db->prepare('SELECT `id` FROM `projects`');
    $stmt->execute();
    $select = $stmt->fetchAll();
    $array = [];
    if(in_array($id, $array)) {
        return $id;
    }
    foreach ($select as $entry) {
        array_push($array, (int)$entry['id']);
    }
    if($id < min($array)) {
        return max($array);
    } else if($id > max($array)) {
        return min($array);
    }
    if($up) {
        roundValueUp($array, $id);
    }
    return roundValueDown($array, $id);
}

/*
 * This function rounds the given value upward to the nearest existing value in the array.
 *
 * @param array $array The array to search.
 *
 * @param numeric $val The value to find the closest match for.
 *
 * @return int The rounded value.
 */
function roundValueUp(array $array, $val) {
    if(!is_numeric($val)) {
        return $val;
    }
    for($i = $val; $i < max($array); $i++) {
        if(in_array($i, $array)) {
            return $i;
        }
    }
    return $val;
}

/*
 * This function rounds the given value downward to the nearest existing value in the array.
 *
 * @param array $array The array to search.
 *
 * @param numeric $val The value to find the closest match for.
 *
 * @return int The rounded value.
 */
function roundValueDown(array $array, $val) {
    if(!is_numeric($val)) {
        return $val;
    }
    for($i = $val; $i > min($array); $i--) {
        if(in_array($i, $array)) {
            return $i;
        }
    }
    return $val;
}


/*
 * Displays the given project. In the grim darkness of the near future, this will be a fancy JS carousel but I looked up how to
 * do this in HTML/CSS and I thought to myself 'self, I can't possibly achieve this in a day and a half let alone do the login
 * task after' so we're going to use horrible hacky POST queries for the time being.
 *
 * @param int id The project ID to get. It is assumed the id corresponds to an actual project beforehand.
 *
 * @return string The HTML to output on the page.
 */
function displayProject(PDO $db, int $id) {
    $stmt = $db->prepare('SELECT `title`,`type`,`desc`,`image`,`link` FROM `projects` WHERE `id`=:id');
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $result = $stmt->fetch();
    $output = '<div class="showcasetext"><h2>' . $result['title'] . '</h2><h3>' . $result['type'] . '</h3><p>' . $result['desc'] .'</p></div>';
    $output .= '<div class="showcaseviewer"><img src="' . $result['image'] . '">';
    $output .= '<form class="showcasenav showcaseprev" method="post"><input type="submit" name="prev_' . $id . '" value="&lt" class="showcasenav showcaseprev"></form>';
    $output .= '<form class="showcasenav showcasenext" method="post"><input type="submit" name="next_' . $id . '" value="&gt" class="showcasenav showcaseprev"></form>';
    $output .= '<div class="showcasebottom"><a href="' .  $result['link'] . '" class="showcaseview">View Project</a></div>';
    return $output;
}



function getProjectID(PDO $db, $get) {
    if(!empty($get)) {
        $command = explode('_', array_keys($get)[0]);
        $id = (int)$command[1];
        if($command[0] == 'prev') {
            return clampProjectID($db,$id - 1, FALSE);
        } else if($command[0] == 'next') {
            return clampProjectID($db,$id + 1, TRUE);
        }
    }
    return getDefaultProject($db);
}

function getDefaultProject(PDO $db) {
    $stmt = $db->prepare('SELECT `id` FROM `projects`');
    $stmt->execute();
    $value = $stmt->fetch();
    return (int)$value['id'];
}


function displayContactInfo(PDO $db) {
    $stmt = $db->prepare('SELECT `value` as icon,`link`,`text` FROM `contact` JOIN `icons` ON `icons`.`id` = `contact`.`icon_id`');
    $stmt->execute();
    $entries = $stmt->fetchAll();
    $output = '';
    foreach ($entries as $entry) {
        $output .= '<li><i class="' . $entry['icon'] . ' "></i> <a href="' . $entry['link'] . '">' . $entry['text'] . '</a></li>';
    }
    return $output;
}
?>