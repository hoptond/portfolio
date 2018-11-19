<?php
/*
 * Outputs the HTML required to display the text in the about me section.
 *
 * @param PDO $db The database object to retrieve the about me information from.
 *
 * @return string Returns the Name, Title and Description wrapped in the correct html tags.
 */
function displayAboutMe(PDO $db) {
    $stmt = $db->prepare('SELECT `name`,`title`,`desc` FROM `about`');
    $stmt->execute();
    $result = $stmt->fetch();
    $name = '<h1>' . $result['name'] . '</h1>';
    $title = '<h2>' . $result['title'] . '</h2>';
    $desc = '<p>' . $result['desc'] . '</p>';
    return $name . $title . $desc;
}
/*
 * Outputs the HTML required to display the badges in the about me section.
 *
 * @param PDO $db The database object to retrieve the about me information from.
 *
 * @return string Returns each badge in the database, wrapped in an <i> tag.
 */
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

function getProjectTexts(array $projects) {
    $output = '';
    for ($i = 0; $i < count($projects); $i++) {
        if($i === 0) {
            $output .= '<div class="showcasetext">
                <h2>' . $projects[$i]['title'] . '</h2>
                <h3>' . $projects[$i]['type'] . '</h3>
                <p>' . $projects[$i]['desc'] .'</p>
               </div>';
        } else {
            $output .= '<div class="hidden showcasetext">
                <h2>' . $projects[$i]['title'] . '</h2>
                <h3>' . $projects[$i]['type'] . '</h3>
                <p>' . $projects[$i]['desc'] .'</p>
               </div>';
        }
    }
    return $output;
}

function getProjectImages(array $projects) {
    $output = '';
    for ($i = 0; $i < count($projects); $i++) {
        if($i === 0) {
            $output .= '<img class="active" src="' . $projects[$i]['image'] . '">';
        } else {
            $output .= '<img class="inactive" src="' . $projects[$i]['image'] . '">';
        }
    }
    return $output;
}

/*
 * Gets the index of the project ID when the user has clicked on either of the nav buttons on the showcase viewer.
 *
 * @param array $array The list of project IDs in the database.
 *
 * @return int Returns the next, previous, lowest, highest, or default ID depending upon which project the user was currently
 * viewing and which navigation button they clicked on.
 */
function getProjectIndex(array $post, array $array) {
    if (empty($array)) {
        return 0;
    }
    if (!empty($post)) {
        $command = explode('_', array_keys($post)[0]);
        $index = (int)$command[1];
        if ($command[0] == 'prev') {
            if (0 > $index - 1) {
                return max(array_keys($array));
            }
            return $index - 1;
        } else if ($command[0] == 'next') {
            if (count($array) <= $index + 1) {
                return 0;
            }
            return $index + 1;
        }
    }
    return 0;
}
/*
 * Gets a numeric array of project IDs from the database.
 *
 * @param PDO $db The database object to retrieve the project information from.
 *
 * @return int Returns a numeric array of project IDs from the database.
 */
function getProjectIDArray(PDO $db) {
    $stmt = $db->prepare('SELECT `id` FROM `projects`');
    $stmt->execute();
    $result = $stmt->fetchAll();
    $array = [];
    foreach($result as $entry) {
        array_push($array, (int)$entry['id']);
    }
    return $array;
}
/*
 * Outputs the HTML required to display each entry in the Contact Me section.
 *
 * @param PDO $db The database object to retrieve the contact information from.
 *
 * @return string Returns a number of <li> elements, enclosing an icon from `icons` and an anchor whose href is set to
 * `link`. `text` is displayed in the place of link.
 */
function displayContactInfo(PDO $db) {
    $stmt = $db->prepare('SELECT `value` as icon,`link`,`text` FROM `contact` JOIN `icons` ON `icons`.`id` = 
                          `contact`.`icon_id`');
    $stmt->execute();
    $entries = $stmt->fetchAll();
    $output = '';
    foreach ($entries as $entry) {
        $output .= '<li><i class="' . $entry['icon'] . ' "></i> <a href="' . $entry['link'] . '">' . $entry['text'] . '</a></li>';
    }
    return $output;
}
?>