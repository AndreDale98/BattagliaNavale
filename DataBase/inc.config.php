<?php
  $cfg['username'] = 'root';
  $cfg['password'] = '';
  $cfg['host'] = '127.0.0.1';
  $cfg['db'] = 'battaglianavale';

  //Non toccare
  $conn = new mysqli($cfg['host'], $cfg['username'], $cfg['password'], $cfg['db']);
  if (mysqli_connect_errno()) {
    echo 'Errore di connessione ('.mysqli_connect_errno.')';
    die();
  }
?>
