<?php

/*
 * Gets a PDO object to use for database queries. This PDO's fetch mode is set to FETCH_ASSOC by default.
 *
 * @Return returns the PDO object to use for our given queries.
 */
function getPDO() {
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

function displayAboutMe() {
    $stmt = getPDO()->prepare('SELECT `name`,`title`,`desc` FROM `about`');
    $stmt->execute();
    $result = $stmt->fetch();
    $name = '<h1>' . $result['name'] . '</h1>';
    $title = '<h2>' . $result['title'] . '</h2>';
    $desc = '<p>' . $result['desc'] . '</p>';
    return $name . $title . $desc;
}

function displayBadges() {
    $stmt = getPDO()->prepare('SELECT `value` FROM `badges`');
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
 * @return int The corrected ID of the project we will be loading.
 */
function clampProjectID(int $id, bool $up) {
    $stmt = getPDO()->prepare('SELECT `id` FROM `projects`');
    $stmt->execute();
    $select = $stmt->fetchAll();
    $array = [];
    foreach ($select as $entry) {
        if($entry['id'] == $id) {
            return $id;
        }
        array_push($array, (int)$entry['id']);
    }

    asort($array);
    if($id < min($array)) {
        return min($array);
    } else if($id > max($array)) {
        return max($array);
    }
    return closestValue($array, $id, $up);
}


function closestValue(array $array, $val, bool $up) {
    $closest = null;
    foreach ($array as $item) {
        if ($closest === null || abs($val - $closest) > abs($item - $val)) {
            $closest = $item;
        }
    }
    return $closest;
}

$array[0] = 1;
$array[1] = 7;
$array[2] = 12;
$array[3] = 13;

var_dump(closestValue($array, 8));

/*
 * Displays the given project. In the grim darkness of the near future, this will be a fancy JS carousel but I looked up how to
 * do this in HTML/CSS and I thought to myself 'self, I can't possibly achieve this in a day and a half let alone do the login
 * task after' so we're going to use GET queries for the time being.
 *
 * @param int id The project ID to get. It is assumed the id corresponds to an actual project beforehand.
 *
 * @return string The HTML to output on the page.
 */
function displayProject(int $id) {
    $stmt = getPDO()->prepare('SELECT `title`,`type`,`desc`,`image`,`link` FROM `projects` WHERE `id`=:id');
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $result = $stmt->fetch();
    $output = '<div class="showcasetext"><h2>' . $result['title'] . '</h2><h3>' . $result['type'] . '</h3><p>' . $result['desc'] .'</p></div>';
    $output .= '<div class="showcaseviewer"><img src="' . $result['image'] . '">';
    $output .= '<button class="showcasenav showcaseprev">&lt;</button><button class="showcasenav showcasenext">&gt;</button>';
    $output .= '<div class="showcasebottom"><a class="showcaseview">View Project</a></div>';
    return $output;
}

function displayContactInfo() {
    $stmt = getPDO()->prepare('SELECT `value` as icon,`link`,`text` FROM `contact` JOIN `icons` ON `icons`.`id` = `contact`.`icon_id`');
    $stmt->execute();
    $entries = $stmt->fetchAll();
    $output = '';
    foreach ($entries as $entry) {
        $output .= '<li><i class="' . $entry['icon'] . ' "></i> <a href="' . $entry['link'] . '">' . $entry['text'] . '</a></li>';
    }
    return $output;
}
?>