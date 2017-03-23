<?php

class DB {

  private $conn;

  public function __construct() {
    $cfg['username'] = 'root';
    $cfg['password'] = '';
    $cfg['host'] = 'localhost';
    $cfg['db'] = 'battaglianavale';

    $this->conn = new mysqli($cfg['host'], $cfg['username'], $cfg['password'], $cfg['db']);
    if (mysqli_connect_errno()) {
      echo 'Errore di connessione ('.mysqli_connect_errno.')';
      die();
    }
  }

  function insertUser($nome, $username, $password){
    echo $nome . " - " .$username . " - " . $password;
    $stmt = $this->conn->prepare("INSERT INTO giocatore (Username, Nome, Password) VALUES (?, ?, ?);");
    $rc = $stmt->bind_param("sss", $username, $nome, $password);
    if (false===$rc) {
      // print_r($stmt);
      // echo $stmt;
      die('bind_param() failed: '.htmlspecialchars($stmt->error));
    } else {
      $rc = $stmt->execute();
      header('location: login.php');
      die();
    }
    $rc = $stmt->execute();
    if (false===$rc) {
      die('execute() failed: '.htmlspecialchars($stmt->error));
    }
    $stmt->close();
  }

  function selectPlayer($username, $password) {
    $stmt = $this->conn-> query('SELECT * FROM Giocatore WHERE Username LIKE "' . $username . '" AND Password="'. $password .'";');
    if($stmt->num_rows > 0) {
      if($stmt->fetch_array(MYSQLI_NUM)) {
        header('location: main.php');
        die();
      } else {
        echo '$message';
      }
    } else {
    }
    echo "ciao player";
  }
}
