<?php










/*
 * Produces the list of entries on each Edit page, with accompanying edit/delete buttons
 *
 * @param string $table The table to get data from.
 *
 * @return Returns the list of entries for the given table, formatted as HTML. If we try and do
 */
function getListHolderData(string $table) {
    if($table == "name")
        return "<div>This section cannot be listed.</div>";
    $output = '<ul><li>';
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('SELECT `:name` FROM `:table`');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $array = $stmt->fetchAll();
    $display = 'value';
    switch ($table) {
        case 'contact':
            $display = 'text';
            break;
        case 'projects':
            $display = 'title';
            break;
    }
    foreach ($array as $entry) {
        $output .= '<div><form><p>' . $entry[$display] .'</p><button class="delete">X</button><button class="edit">EDIT</button></form></div>';
    }
    return $output .= '</li></ul>';
}






/*
 * Updates the data in the about table.
 *
 * @return Returns TRUE if the update was successful, FALSE if otherwise.
 */
function updateAbout() {
    if (!isset($_POST['name'])) {
        return FALSE;
    }
    $name = $_POST['name'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];

    //sanitize all strings

    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('UPDATE `about` SET `name` = :name, `title` = :title, `desc` = :desc');
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':title',$title);
    $stmt->bindParam(':name',$desc);
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
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('SELECT `title`,`type`,`desc`,`image`,`link` FROM `projects` WHERE `id` = :id LIMIT 1');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
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
    $project['name'] = $postData['name'];
    $project['type'] = $postData['type'];
    $project['desc'] = $postData['desc'];
    $project['image'] = $postData['image'];
    $project['link'] = $postData['link'];
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
    $contact['id'] = $postData['id'];
    $contact['link'] = $postData['link'];
    $contact['text'] = $postData['text'];
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
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('INSERT INTO `projects`(`title`, `type`, `desc`,`image`,`link`) VALUES(:name, :type, :desc, :image, :link)');
    $stmt->bindParam(':name',$project['name']);
    $stmt->bindParam(':title',$project['title']);
    $stmt->bindParam(':desc',$project['desc']);
    $stmt->bindParam(':img',$project['img']);
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
function upateProjectInDatabase(int $id, array $project) {
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('UPDATE `projects` SET `name`=:name, `type`=:type, `desc`=:desc, `image`=:image, `link`=:link,  WHERE `id`=:id');
    $stmt->bindParam(':name',$project['name']);
    $stmt->bindParam(':title',$project['title']);
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
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('INSERT INTO `contact`(`icon_id`, `link`, `text`) VALUES(:icon_id, :link, :text)');
    $stmt->bindParam(':icon_id',$contact['id']);
    $stmt->bindParam(':link',$contact['link']);
    $stmt->bindParam(':text',$contact['text']);
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
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('UPDATE `contact` SET `icon_id`=:icon_id, `link`=:type, `text`=:text WHERE `id`=:id');
    $stmt->bindParam(':icon_id',$contact['id']);
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

    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('SELECT `icon_id`,`link`,`text` FROM `contact` WHERE `id` = :id LIMIT 1');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
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
function addSingleValueToTable(string $table, string $value) {
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('INSERT INTO `:table`(`value`) VALUES(:value)');
    $stmt->bindParam(':table',$table);
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
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('UPDATE `:table` SET `value`=:value WHERE `id`=:id');
    $stmt->bindParam(':table',$table);
    $stmt->bindParam(':value',$value);
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

    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('SELECT `value` FROM `:table` WHERE `id` = :id LIMIT 1');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->bindParam(':table',$table);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $entry = $stmt->fetch();
    return $entry;
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
    $db = new PDO('mysql:dbname=CMS;host=127.0.0.1','root');
    $stmt = $db->prepare('DELETE FROM :table WHERE id = :id');
    $stmt->bindParam(':table',$table);
    $stmt->bindParam(':id',$id);
    return $stmt->execute();
}
