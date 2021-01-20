<?php
  if($_SERVER['SERVER_NAME'] != 'localhost') {
    include '../../helpers/connect-db.php';
  
    $dbconn = connect_db();
  }
  
  header('Content-Type: application/json');
  
  $result = array();
  
  $result['api_status'] = 1;
  $result['api_message'] = 'Logout success';
  
  include '../../helpers/retrieve-post-params.php';
  $params = retrieve_post_params($_POST, file_get_contents('php://input'));

  if (!isset($params['id']) || $params['id'] == '') {
    $result['api_status'] = 0;
    $result['api_message'] = 'id parameter is required';

    echo json_encode($result);

    exit;
  }

  if (!$dbconn) {
    $result['api_status'] = 0;
    $result['api_message'] = 'Failed on connecting to database';

    echo json_encode($result);

    exit;
  }

  $data = pg_fetch_all(pg_query($dbconn, "SELECT * FROM users WHERE id = " . $params['id'] . ";"));

  if (count($data) == 0) {
    $result['api_status'] = 0;
    $result['api_message'] = "Account with id of " . $params['id'] . " is not found";

    echo json_encode($result);

    exit;
  }

  echo json_encode($result);
?>