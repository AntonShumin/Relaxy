<?php
session_start();
echo ini_get('session.cookie_domain');
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Session Test</title>
    </head>
    <body>
        <p>Hello
            <?php
                if(isset($_SESSION['first_name'])) {
                    echo 'again, ' . $_SESSION['first_name'];
                } else {
                    echo ", stranger dawg";
                }
            ?>
        </p>
        <p><a href="session_01.php">Go to page 1</a> </p>
    </body>
</html>
