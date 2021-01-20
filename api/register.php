<?php
  if($_SERVER['SERVER_NAME'] != 'localhost') {
    include '../helpers/connect-db.php';
  
    $dbconn = connect_db();
  }
  
  header('Content-Type: application/json');
  
  $result = array();
  
  $result['api_status'] = 1;
  $result['api_message'] = 'Success creating account';
  
  include '../helpers/retrieve-post-params.php';
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

  if (!isset($params['confirm_password']) || $params['confirm_password'] == '') {
    $result['api_status'] = 0;
    $result['api_message'] = 'confirm_password parameter is required';

    echo json_encode($result);

    exit;
  }

  if ($params['password'] != $params['confirm_password']) {
    $result['api_status'] = 0;
    $result['api_message'] = 'confirm_password is not match with password';

    echo json_encode($result);

    exit;
  }

  if (!$dbconn) {
    $result['api_status'] = 0;
    $result['api_message'] = 'Failed on connecting to database';

    echo json_encode($result);

    exit;
  }

  $data = pg_query($dbconn, "INSERT INTO users (username, password) VALUES ('" . $params['username'] . "', '" . $params['password'] . "');");

  if (!$data) {
    $result['api_status'] = 0;
    $result['api_message'] = 'Failed on processing data';

    echo json_encode($result);

    exit;
  }

  echo json_encode($result);
?>