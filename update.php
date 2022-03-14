<?php

$connection = new mysqli('localhost', 'root', '', 'website');

// when connection is failed show to end user 
//  to check the configuration parameters DB
if (!$connection) {
    echo 'connection to the database is failed!';
    die;
}

// Change character set to utf8
$connection->set_charset("utf8");

$id = $_GET['id'];
$name = $_POST['name'];
$email = $_POST['email'];

// prepare the sql query and run it
$sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

$result = $connection->query($sql);

// close connection after process finish
$connection->close();

if(!$result){
    echo 'Profile Edited Fails ☹';
    return;
}

echo 'Profile Edited Successfully!';