<?php
  if($_SERVER['SERVER_NAME'] != 'localhost') {
    include '../helpers/connect-db.php';
  
    $dbconn = connect_db();
  }

  header('Content-Type: application/json');

  $result = array();

  $result['api_status'] = 1;
  $result['api_message'] = '';
  $result['data'] = array();
  
  $params = $_GET;

  if (!isset($params['owner_id'])) {
    $result['api_status'] = 0;
    $result['api_message'] = 'owner_id parameter is required';

    echo json_encode($result);

    exit;
  }
  
  if (!$dbconn) {
    $result['api_status'] = 0;
    $result['api_message'] = 'Failed on connecting to database';

    echo json_encode($result);

    exit;
  }

  $result['data'] = pg_fetch_all(pg_query($dbconn, "SELECT * FROM notes WHERE owner_id = " . $params['owner_id'] . " ORDER BY id ASC;"));

  echo json_encode($result);
?>