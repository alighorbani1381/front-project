<?php

$message = '';
$style = '';

// if any data posted into this page
if (count($_POST)) {

    $connection = new mysqli('localhost', 'root', '', 'website');

    // when connection is failed show to end user 
    //  to check the configuration parameters DB
    if (!$connection) {
        echo 'connection to the database is failed!';
        die;
    }

    // Change character set to utf8
    $connection->set_charset("utf8");


    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // prepare the sql query and run it
    $sql = "INSERT INTO users (name , email, password) VALUES ('$name' , '$email', '$password')";
    $result = $connection->query($sql);

    // show result to end user
    if (!$result) {
        $message = 'Signup Fails!';
        $style = 'danger';
    } else {
        $message = 'Signup Successfully :)';
        $style = 'success';
    }

    // close connection after process finish
    $connection->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Signup Form</title>
</head>

<body>
    <div class="holder">

        <h3># Signup Form</h3>
        <form id="info" method="post">
            <label>Name</label><input type="text" required name="name"><br><br>
            <label>Email</label><input type="email" required name="email"><br><br>
            <label>Password</label><input id="password" type="password" required name="password"><br><br>
            <label>Pass Confirm</label><input id="confirm_password" type="password" required name="passwordConfirm"><br><br>

            <?php if ($message) : ?>
                <div class="message <?= $style ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <input class="btn" type="submit" value="Signup">
        </form>
    </div>

    <script src="public/js/script.js"></script>
</body>

</html>