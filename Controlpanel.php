<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel</title>
</head>
<body>
    <!-- <h1>Welcome to admin control panel</h1> -->
    <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo ("<br>Hi Mr/Ms ". $_SESSION['username']. ", welcome to system admin panel.");
        }
        else
            echo ("<br>Sorry!!! Unauthorized access");

    ?>
</body>
</html>