<?php
  if($_SERVER['SERVER_NAME'] != 'localhost') {
    include '../helpers/connect-db.php';
  
    $dbconn = connect_db();
  }

  header('Content-Type: application/json');
  
  $result = array();

  $result['api_status'] = 1;
  $result['api_message'] = 'Success editing note';

  include '../helpers/retrieve-post-params.php';
  $params = retrieve_post_params($_POST, file_get_contents('php://input'));

  if (!isset($params['id'])) {
    $result['api_status'] = 0;
    $result['api_message'] = 'id parameter is required';

    echo json_encode($result);

    exit;
  }

  if (!isset($params['text_value'])) {
    $result['api_status'] = 0;
    $result['api_message'] = 'text_value parameter is required';

    echo json_encode($result);

    exit;
  }

  if (!$dbconn) {
    $result['api_status'] = 0;
    $result['api_message'] = 'Failed on connecting to database';

    echo json_encode($result);

    exit;
  }

  $data = pg_query($dbconn, "UPDATE notes SET text_value = '" . $params['text_value'] . "' WHERE id = " . $params['id'] . ";");

  if (!$data) {
    $result['api_status'] = 0;
    $result['api_message'] = 'Failed on processing data';

    echo json_encode($result);

    exit;
  }

  echo json_encode($result);
?>