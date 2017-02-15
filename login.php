<?php 

require_once 'Database/DB.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
  
    $db = new DB();
    $db->selectPlayer($username, $password);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="login.css" type="text/css" rel="stylesheet">
    </head>
    <body class="body">
        <div class="login">
            <div class="image">
                <div class="title">
                    Battaglia navale
                </div>
                <img src="image/title.jpg" id="titleImage">
            </div>
            <form class="loginTitle" method="POST" action="#">
                <div class="title">
                    Login
                </div>
                <div class="input">
                    Username: <input type="text" name="username"><br>
                    <p></p>
                   Password: <input type="password" name="password">
                </div>
                <div class="play">
                    <div class="register">
                        <a href="register.php">Registrarsi</a>
                    </div>
                    <div class="login-button">
                        <input type="submit" value="Login" name="login">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>

