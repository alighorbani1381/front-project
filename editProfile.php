<?php

$id = $_GET['id'] ?? null;

if (!$id) {
    die('You Must Enter Id then you can edit for example ?id=1');
}

$user = getUserById($id);

if(!$user){
    die('The Id That you passed is not valid !');
}

function getUserById($id)
{
    $connection = new mysqli('localhost', 'root', '', 'website');

    // when connection is failed show to end user 
    //  to check the configuration parameters DB
    if (!$connection) {
        echo 'connection to the database is failed!';
        die;
    }

    // Change character set to utf8
    $connection->set_charset("utf8");


    // prepare the sql query and run it
    $sql = "SELECT * FROM users WHERE id=$id";

    $result = $connection->query($sql);

    $user = $result->fetch_object();

    // close connection after process finish
    $connection->close();

    return $user;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Edit Form</title>
</head>

<body>
    <div class="holder">

        <h3># Edit Form</h3>
        <form id="info" method="post" action="update.php?id=<?= $user->id ?>">
            <label>Name</label><input type="text" required name="name" value="<?= $user->name ?>"><br><br>
            <label>Email</label><input type="email" required name="email" value="<?= $user->email ?>"><br><br>
            <input class="btn" type="submit" value="Edit Profile">
        </form>
    </div>

    <script src="public/js/script.js"></script>
</body>

</html>