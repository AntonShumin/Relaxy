<?php

session_start();
if(isset($_POST['first_name'])) {
    if(!empty($_POST['first_name'])) {
        $_SESSION['first_name'] = htmlentities($_POST['first_name']);
    } else {
        $_SESSION['first_name'] = 'Bashful';
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Session Test</title>
    </head>
    <body>
        <p>Hello, <?php
            if(isset($_SESSION['first_name'])) {
                echo $_SESSION['first_name'];
            } else {
                echo 'stranger';
            }
        ?> </p>
        <p><a href="session_03.php">Go to page 3</a> </p>
    </body>
</html>
