<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
            .login {
        width: 360px;
        margin: 58px auto;
        font-family: Georgia;
        border-radius: 10px;
        border: 2px solid #ccc;
        padding: 10px 40px 10px;
        margin-top: 10px;
    }
    input[type = text], input[type = password], select {
        width:  90%;
        padding: 5px;
        margin-top: 2px;
        margin-bottom: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
        padding-left: 5px;
        font-size: 16px;
        font-family: Georgia;
    }
    input[type = submit] {
        width: 100%;
        background-color: #009;
        color: #fff;
        border: 2px solid #06f;
        padding: 7px;
        font-size: 20px;
        cursor: pointer;
        border-radius: 5px;
        margin-bottom: 5px;
    }
    h1 {
        text-align: center;
    }
    a {
        float: right;
        padding-right: 20px;
        text-decoration: none;
    }
    span {
        color: red;        
        font-weight: bold;
        text-align: center;
    }
    </style>
</head>
<body>
    <?php
        $message = "";
        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            // setcookie("username", $username, time()-60*60*24*30); //1 month
            // setcookie("password", $password, time()-60*60*24*30);
            // // echo ("<br>Ready to process cookie");
            session_start();
            $_SESSION['username'] = $_COOKIE['username'];
            $_SESSION['password'] = $_COOKIE['password'];
            $cname = $_COOKIE['username'];
            $cpass = $_COOKIE['password'];
            header ("Location: Controlpanel.php");
            
        }
        else {
            if (isset($_POST['submit'])) {
                if (!empty($_POST['username']) && !empty($_POST['password'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    require_once ("Connection.php");
                    if (!$conn->connect_error) {
                        $sql = "select * from users where username = '$username' and password = '$password';";
                        $result = $conn->query ($sql);
                        if ($result->num_rows == 1) {
                            if (isset($_POST['rememberme'])) {
                                setcookie("username", $username, time()+60*60*24*30); //1 month
                                setcookie("password", $password, time()+60*60*24*30);
                            }
                            session_start();
                            $_SESSION['username'] = $username;
                            header ("Location: Controlpanel.php");
                        }
                        else
                        $message = "Invalid username or password";
                    }
                }
                else 
                    $message = "Please fill in the required fields";
            }
        }
    ?>
    <div class = "login">
    <h1>Login Form</h1>
    <form method="post" action = "">
    User name: <input type="text" name="username" id="username" value = "<?php echo $cname ?>"><br>
    Password: <input type="password" name="password" id="password" value= "<?php echo $cpass ?>"><br>
    <input type="checkbox" name="rememberme" value="1">Remember me 
    <a href="Createuser.php" target="_blank">Sign up</a>
    <a href="ForgotPassword.php" target="_blank">Forgot Password</a>
    <br><br>
    <input type="submit" name="submit" value="Login">
    </form>
    <?php
        echo ("<span>$message</span>");
    ?>
    </div>
</body>
</html>