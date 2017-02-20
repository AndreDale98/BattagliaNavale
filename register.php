<?php
require_once 'DataBase/DB.php';
require_once 'Classes/User.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    
    $db = new DB();
    $db->insertUser($nome, $username, $password);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="CSS/register.css" type="text/css" rel="stylesheet">
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
                    Registrazione
                </div>
                <div class="input">
                    Nome: <input type="text" name="nome"><br>
                    <p></p>
                    Username: <input type="text" name="username"><br>
                    <p></p>
                   Password: <input type="password" name="password">
                </div>
                <div class="play">
                    <div class="login-button">
                        <input type="submit" value="Crea account" name="login">
                    </div>
                </div>
                <div class="error" id="error">
                    <!Username o password errati! Per favore riprovare.>
                </div>
            </form>
        </div>
    </body>
</html>


