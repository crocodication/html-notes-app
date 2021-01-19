<?php
  function connect_db() {
    $host = getenv('host');
    $port = getenv('port');
    $dbname = getenv('dbname');
    $user = getenv('user');
    $password = getenv('password');

    $dbconn = pg_connect("host=" . $host . " port=" . $port . " dbname=" . $dbname . " user=" . $user . " password=" . $password);

    return $dbconn;
  }
?>