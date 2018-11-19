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

/*
 * Outputs the HTML required to display the project details in the showcasetext section. Only the first entry
 * is visible by default
 *
 * @param array $projects: An array contaning an associative array of information for each project.
 *
 * @return string Returns the information for each project, wrapped in the appropriate tags.
 */
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

/*
 * Outputs the HTML required to display the project images in the carousel. Only the first entry
 * is visible by default
 *
 * @param array $projects: An array contaning an associative array of information for each project.
 *
 * @return string Returns the HTML to display images for each project, wrapped in the appropriate tags.
 */
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

function getProjectLinks(array $projects) {
    $output = '';
    for ($i = 0; $i < count($projects); $i++) {
        $output .= '<div class="showcasebottom hidden">
                            <span>' . getProjectLinkSpanContent($projects[$i]) .'</span>
                        </div>';
    }
    return $output;
}

function getProjectLinkSpanContent(array $project) {
    $output = '';
    if (!empty($project['repo_link'])) {
        if (!empty($project['use_link'])) {
           $output .= '<a class="showcaseview" href="' . $project['repo_link'] . '">View Project</a><a> / </a>' .
               '<a class="showcaseview" href="' . $project['use_link'] . '">Demo</a>';
           return $output;
        } else {
            $output .= '<a class="showcaseview" href="' . $project['repo_link'] . '">View Project</a>';
        }
    }
    if (!empty($project['use_link'])) {
        $output .= '<a class="showcaseview" href="' . $project['use_link'] . '">View Demo</a>';
    }
    return $output;
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