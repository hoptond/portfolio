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

/*
 * Displays the form for editing the About Me section of the portfolio. The value for each input is filled automatically with the current entry
 * in the database.
 *
 * @return Returns the input elements for the About Me form, formatted as HTML. This should be placed inside a form element, before the submit
 * element.
 */
function displayAboutMeInput() {
    $stmt = getPDO()->prepare('SELECT `name`,`title`,`desc` FROM `about` LIMIT 1');
    $stmt->execute();
    $array = $stmt->fetch();
    $output = '<div class="longinput"><label>Name: </label><input name="name" type="text" value="' . $array['name'] . '"></div>';
    $output .= '<div class="longinput"><label>Title: </label><input name="title" type="text" value="' . $array['title'] . '"></div>';
    $output .= '<div class="longinputlarge"><label>Desc: </label><textarea name="desc">' . $array['desc'] . '</textarea></div></div>';
    return $output;
}

/*
 * Displays the form for editing a single value table, such as the Badges or Icons table. If there is a given entry to edit, the value
 * is filled with the current entry.
 *
 * @param int $id The given entry to edit. This value is 0 if we are adding a new entry.
 *
 * @param int $table The given table to retrieve data from.
 *
 * @return Returns the input element for the given table, formatted as HTML. This should be placed inside the form element, before the submit
 * element.
 */
function displaySingleValueInput(int $id, string $table) {
    $value = '';
    $hidden = '';
    if($id > -1) {
        $value = getSingleValueFromDB($id, $table)['value'];
        $hidden ='<input type="hidden" name="id" value ="' . $id . '">';
    }
    $label = substr(ucfirst($table),0, strlen($table) - 1) . ': ';
    return $hidden . '<label>' . $label . ' </label><input name="value" type="text" value="' . $value . '"/>';
}

/*
 * Called upon loading the main form section of each edit page. This retrieves the edit ID from the GET data, if one is present.
 *
 * @param array $getData The $_GET data we are checking.
 *
 * @return int Returns the ID of the entry the user wants to edit. If the user is not editing a specific entry, return minus -1.
 */
function getEditEntryID($getData) : int {
    if(!key_exists('edit', $getData) ||!key_exists('id', $getData)) {
        return -1;
    }
    return (int)$getData['id'];
}


/*
 * Displays the form for editing projects. If there is a valid entry in the database, the values of each input field are filled out
 * with the appropriate data.
 *
 * @param int $id The id of the entry to edit.
 *
 * @return Returns the input element for the given table, formatted as HTML. This should be placed inside the form element, before the submit
 * element.
 */
function displayEditProjectInput(int $id) {
    if($id < 1) {
        return '';
    }
    $array = getProjectFromDB($id);
    $output = '<form name="project" action="doeproject.php" method="post">';
    $output .= '<div class="longinput"><label>Title: </label><input name="title" type="text" value="' . $array['title'] . '"></div>';
    $output .= '<div class="longinput"><label>Type: </label><input name="type" type="text" value="' . $array['type'] . '"></div>';
    $output .= '<div class="longinputlarge"><label>Desc: </label><textarea name="desc">' . $array['desc'] . '</textarea></div>';
    $output .= '<div class="longinput"><label>Image: </label><input name="img" type="text" value="' . $array['image'] . '"></div>';
    $output .= '<div class="longinput"><label>Link: </label><input name="link" type="text" value="' . $array['link'] . '"></div>';
    $output .= '<input type="hidden" name="id" value ="' . $id . '">';
    $output .= '<input type="submit" value="Edit"></form>';
    return $output;
}

/*
 * Displays the form for editing contact information. If there is a valid entry in the database, the values of each input field are filled out
 * with the appropriate data.
 *
 * @param int $id The given entry to edit. This value is 0 if we are adding a new entry.
 *
 * @return Returns the input element for the given table, formatted as HTML. This should be placed inside the form element, before the submit
 * element.
 */
function displayEditContactInfo(int $id) {
    $array = getContactInfoFromDB($id);
    $output = '<div class="longinput"><label>Icon ID: </label><input name="icon_id" type="text" value="' . $array['icon_id'] . '"></div>';
    $output .= '<div class="longinput"><label>Link: </label><input name="link" type="text" value="' . $array['link'] . '"></div>';
    $output .= '<div class="longinput"><label>Text: </label><input name="text" type="text" value="' . $array['text'] . '"></div>';
    if($id != -1) {
        $output .= '<input type="hidden" name="id" value ="' . $id . '">';
    }
    return $output;
}

function processMessage(int $id) {
    switch ($id){
        case 1: return 'About Me updated successfully!';
        case 2: return 'Badge added successfully!';
        case 3: return 'Badge edited successfully!';
        case 4: return 'Project added successfully!';
        case 5: return 'Project edited successfully!';
        case 6: return 'Contact Info added successfully!';
        case 7: return 'Contact Info edited successfully!';
        case 8: return 'Icon added successfully!';
        case 9: return 'Icon edited successfully!';
        case 10: return 'Required field missing. Please try again.';
        case 11: return 'Field not in valid format. Please try again.';
        case 12: return 'Error adding entry into database. Please try again.';
        case 13: return 'Error updating entry in database. Please try again.';
        case 14: return 'Error deleting entry from database.';
        case 15: return 'Deleted entry from the database';
    }
    return '';
}

/*
 * Produces the list of entries on each Edit page, with accompanying edit/delete buttons
 *
 * @param string $table The table to get data from.
 *
 * @return Returns the list of entries for the given table, formatted as HTML. If we try a table where there is only a single row,
 * such as the about table, we will receive an informative message instead telling us that this operation is not valid.
 */
function displayListHolderData(string $table, int $highlight = -1) {
    if(!validateListTableRequest($table)) {
        return "<div>This section cannot be listed.</div>";
    }
    $output = '<ul><li>';
    //i am aware using * is a cardinal sin but I see no better way of doing what I want to do
    $stmt = getPDO()->prepare('SELECT * FROM ' . $table);
    $display = 'value';
    switch ($table) {
        case 'contact':
            $display = 'text';
            break;
        case 'projects':
            $display = 'title';
            break;
    }
    $stmt->execute();
    $array = $stmt->fetchAll();
    $action = '';
    switch ($table)
    {
        case 'projects': $action = 'doeproject.php'; break;
        case 'icons': $action = 'doeicon.php'; break;
        case 'badges': $action = 'doebadge.php'; break;
        case 'contact': $action = 'doecontact.php'; break;
    }
    foreach($array as $entry) {
        $disp = $entry[$display];
        if($table === 'icons') {
            $disp = $entry['id'] . ': ' . $disp;
        }
        //I am aware this is overly long
        $output .= '<div><p' . listTextColor($entry, $highlight) . '>' . $disp .'</p><div class="listbuttons"><form method="post" action ="' . $action . '"><input class="edit" name="edit_' . $entry['id'] . '" type="submit" value="EDIT"></form><form method="post" action ="' . $action . '"><input class="delete" name="del_' . $entry['id'] . '" type="submit" value="X"></form></div></div>';
    }
    return $output .= '</li></ul>';
}
/*
 * Gets the text color for this list entry. If the highlight ID matches the entry in the database this entry will appear in a different color.
 *
 * @param string $entry The entry in the list
 *
 * @param int $highlight The ID we are comparing against.
 *
 * @return Returns the class to append insert into the HTML if this is the highlighted element. Otherwise, return an empty string.
 */
function listTextColor($entry, $highlight) {
    if((int)$entry['id'] === $highlight) {
        return ' class="highlight"';
    }
    return'';
}

/*
 * Updates the data in the about table.
 *
 * @return Returns TRUE if the update was successful, FALSE if otherwise.
 */
function updateAbout($about) {
    if (!isset($about['name']) || !isset($about['title']) || !isset($about['desc'])) {
        return FALSE;
    }
    $name = filter_var($about['name'], FILTER_SANITIZE_STRING);
    $title = filter_var($about['title'], FILTER_SANITIZE_STRING);
    $desc = filter_var($about['desc'], FILTER_SANITIZE_STRING);
    $stmt = getPDO()->prepare('UPDATE `about` SET `name` = :name, `title` = :title, `desc` = :desc');
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':title',$title);
    $stmt->bindParam(':desc',$desc);
    return $stmt->execute();
}

/*
 * Gets the project data in the database under the given id.
 *
 * @param int id The unique ID of the target project.
 *
 * @return $array Returns an associative array of the project's name, type, description, link and image OR false if there was no
 * project of that ID in the database.
 */
function getProjectFromDB(int $id) {
    $stmt = getPDO()->prepare('SELECT `title`,`type`,`desc`,`image`,`link` FROM `projects` WHERE `id` = :id LIMIT 1');
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $project = $stmt->fetch();
    return $project;
}


/*
 * Gets the project data from the POST and returns it as an associative array.
 *
 * @param array postData The post data as an array.
 *
 * @return $array Returns an associative array of the project's name, type, description, link and image.
 */
function getProjectDataFromPOST($postData) {
    $project = [];
    $project['title'] = filter_var($postData['title'], FILTER_SANITIZE_STRING);
    $project['type'] = filter_var($postData['type'], FILTER_SANITIZE_STRING);
    $project['desc'] = filter_var($postData['desc'], FILTER_SANITIZE_STRING);
    $project['img'] = filter_var($postData['img'], FILTER_SANITIZE_STRING);
    $project['link'] = filter_var($postData['link'], FILTER_SANITIZE_STRING);
    return $project;
}


/*
 * Gets the contact info entry from the POST and returns it as an associative array.
 *
 * @param array postData The post data as an array.
 *
 * @return $array Returns an associative array of the project's name, type, description, link and image.
 */
function getContactInfoFromPOST($postData) {
    $contact = [];
    $contact['icon_id'] = filter_var($postData['icon_id'], FILTER_SANITIZE_STRING);
    $contact['link'] = filter_var($postData['link'], FILTER_SANITIZE_STRING);
    $contact['text'] = filter_var($postData['text'], FILTER_SANITIZE_STRING);
    return $contact;
}

/*
 * Adds a new project to the database.
 *
 * @param array $project An associative array containing all the project information.
 *
 * @return Returns TRUE if the project was added successfully, FALSE if otherwise.
 */
function addProjectToDatabase($project) {
    $stmt = getPDO()->prepare('INSERT INTO `projects`(`title`, `type`, `desc`,`image`,`link`) VALUES(:title, :type, :desc, :image, :link)');
    $stmt->bindParam(':title',$project['title']);
    $stmt->bindParam(':type',$project['type']);
    $stmt->bindParam(':desc',$project['desc']);
    $stmt->bindParam(':image',$project['img']);
    $stmt->bindParam(':link',$project['link']);
    return $stmt->execute();
}

/*
 * Edits an existing project in the database.
 *
 * @param int $id The ID of the project to edit.
 *
 * @param array $project An associative array containing all the project information.
 *
 * @return Returns TRUE if the project was edited successfully, FALSE if otherwise.
 */
function updateProjectInDatabase(int $id, $project) {
    $stmt = getPDO()->prepare('UPDATE `projects` SET `title`=:title, `type`=:type, `desc`=:desc, `image`=:img, `link`=:link  WHERE `id`=:id');
    $stmt->bindParam(':title',$project['title']);
    $stmt->bindParam(':type',$project['type']);
    $stmt->bindParam(':desc',$project['desc']);
    $stmt->bindParam(':img',$project['img']);
    $stmt->bindParam(':link',$project['link']);
    $stmt->bindParam(':id',$id);
    return $stmt->execute();
}

/*
 * Adds a new contact info entry to the database.
 *
 * @param array contact An associative array containing all the contact information.
 *
 * @return Returns TRUE if the contact info was added successfully, FALSE if otherwise.
 */
function addContactInfoToDatabase(array $contact) {
    $stmt = getPDO()->prepare('INSERT INTO `contact`(`icon_id`, `link`, `text`) VALUES(:icon_id, :link, :text)');
    $stmt->bindParam(':icon_id',$contact['icon_id']);
    $stmt->bindParam(':link',$contact['link']);
    $stmt->bindParam(':text',$contact['text']);
    var_dump($contact);
    return $stmt->execute();
}

/*
 * Edits existing contact info in the database.
 *
 * @param int $id The ID of the project to edit.
 *
 * @param array $project An associative array containing all the project information.
 *
 * @return Returns TRUE if the project was edited successfully, FALSE if otherwise.
 */
function updateContactInfoInDatabase(int $id, array $contact) {
    $stmt = getPDO()->prepare('UPDATE `contact` SET `icon_id`=:icon_id, `link`=:link, `text`=:text WHERE `id`=:id');
    $stmt->bindParam(':icon_id',$contact['icon_id']);
    $stmt->bindParam(':link',$contact['link']);
    $stmt->bindParam(':text',$contact['text']);
    $stmt->bindParam(':id',$id);
    return $stmt->execute();
}

/*
 * Gets the contact info in the database under the given id.
 *
 * @param int id The unique ID of the target project.
 *
 * @return array Returns an associative array of the project's name, type, description, link and image OR false if there was no
 * project of that ID in the database.
 */
function getContactInfoFromDB(int $id) {
    $stmt = getPDO()->prepare('SELECT `icon_id`,`link`,`text` FROM `contact` WHERE `id` = :id LIMIT 1');
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $contact = $stmt->fetch();
    return $contact;
}

/*
 * Adds an entry to a table with a single column. Used for the badge/icon tables
 *
 * @param string table The table we are adding the entry into.
 *
 * @param string value The value of our entry.
 *
 * @return bool Returns TRUE if the entry was added, otherwise false
 */
function addSingleValueToTable(string $table, $value) {
    if(!validateSingleTableRequest($table)) {
        return FALSE;
    }
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('INSERT INTO ' . $table. '(`value`) VALUES(:value)');
    $stmt->bindParam(':value',$value);
    return $stmt->execute();
}

/*
 * Edits an existing single value entry in the given table
 *
 * @param int $id The ID of the entry to edit.
 *
 * @param string $table The table we are updating.
 *
 * @param string $value The value we are setting the row to.
 *
 * @return Returns TRUE if the project was edited successfully, FALSE if otherwise.
 */
function updateSingleValueInTable(int $id, string $table, string $value) {
    if(!validateSingleTableRequest($table)) {
        return FALSE;
    }
    $stmt = getPDO()->prepare('UPDATE ' . $table .  ' SET `value`=:value WHERE `id`=:id');
    $stmt->bindParam(':value',filter_var($value, FILTER_SANITIZE_STRING));
    $stmt->bindParam(':id',$id);
    return $stmt->execute();
}

/*
 * Gets the contact info in the database under the given id.
 *
 * @param int id The unique ID of the target project.
 *
 * @return array Returns an associative array of the project's name, type, description, link and image OR false if there was no
 * project of that ID in the database.
 */
function getSingleValueFromDB(int $id, string $table) {
    if(!validateSingleTableRequest($table)) {
        return FALSE;
    }
    $stmt = getPDO()->prepare('SELECT `value` FROM ' . $table . ' WHERE `id` = :id;');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $entry = $stmt->fetch();
    return $entry;
}

/*
 * Checks if we are editing the correct single column table, since targeting other tables with spoofed POST data is a thing.
 *
 * @param string $table The table the user is trying to change.
 *
 * return bool Returns TRUE if the table can be accessed in this way, otherwise FALSE.
 */
function validateSingleTableRequest($table) {
    if($table !== 'icons' && $table !== 'badges') {
        return FALSE;
    }
    return TRUE;
}

/*
 * Checks if we are editing a valid table.
 *
 * @param string $table The given table to validate.
 *
 * return bool Returns TRUE if $table is a valid table, otherwise false.
 */
function validateListTableRequest(string $table) {
    $values[0] = 'badges';
    $values[1] = 'contact';
    $values[2] = 'icons';
    $values[3] = 'projects';
    foreach ($values as $value) {
        if($table === $value) {
            return TRUE;
        }
    }
    return FALSE;
}

/*
 * Deletes the given entry in the database.
 *
 * @param int id The row to delete.
 *
 * @param string table The table to remove data from.
 *
 * @return Returns TRUE if the deletion was successful, otherwise false
 */
function deleteEntryInDB(int $id, string $table) {
    $stmt = getPDO()->prepare('DELETE FROM ' . $table .' WHERE id = :id');
    var_dump($table);
    $stmt->bindParam(':id',$id);
    var_dump($id);
    return $stmt->execute();
}
