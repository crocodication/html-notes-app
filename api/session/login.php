<?php
  if($_SERVER['SERVER_NAME'] != 'localhost') {
    include '../../helpers/connect-db.php';
  
    $dbconn = connect_db();
  }
  
  header('Content-Type: application/json');
  
  $result = array();
  
  $result['api_status'] = 1;
  $result['api_message'] = 'Login success';
  $result['data'] = array();
  
  include '../../helpers/retrieve-post-params.php';
  $params = retrieve_post_params($_POST, file_get_contents('php://input'));

  if (!isset($params['username']) || $params['username'] == '') {
    $result['api_status'] = 0;
    $result['api_message'] = 'username parameter is required';

    echo json_encode($result);

    exit;
  }

  if (!isset($params['password']) || $params['password'] == '') {
    $result['api_status'] = 0;
    $result['api_message'] = 'password parameter is required';

    echo json_encode($result);

    exit;
  }

  if (!$dbconn) {
    $result['api_status'] = 0;
    $result['api_message'] = 'Failed on connecting to database';

    echo json_encode($result);

    exit;
  }

  $data = pg_fetch_all(pg_query($dbconn, "SELECT * FROM users WHERE username = '" . $params['username'] . "';"));

  if (count($data) == 0) {
    $result['api_status'] = 0;
    $result['api_message'] = "Account with username of '" . $params['username'] . "' is not found";

    echo json_encode($result);

    exit;
  }

  if($data[0]['password'] != $params['password']) {
    $result['api_status'] = 0;
    $result['api_message'] = "Wrong password";

    echo json_encode($result);

    exit;
  }

  $result['data'] = pg_fetch_all(pg_query($dbconn, "SELECT id, username, created_at FROM users WHERE username = '" . $params['username'] . "';"))[0];

  echo json_encode($result);
?>