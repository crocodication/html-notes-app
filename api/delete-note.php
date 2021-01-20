<?php
  if($_SERVER['SERVER_NAME'] != 'localhost') {
    include '../helpers/connect-db.php';
  
    $dbconn = connect_db();
  }

  header('Content-Type: application/json');
  
  $result = array();

  $result['api_status'] = 1;
  $result['api_message'] = 'Success deleting note';
  $result['data'] = array();

  include '../helpers/retrieve-post-params.php';
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

  $processing_data = pg_query($dbconn, "DELETE FROM notes WHERE id = " . $params['id'] . ";");

  if (!$processing_data) {
    $result['api_status'] = 0;
    $result['api_message'] = 'Failed on processing data';

    echo json_encode($result);

    exit;
  }

  $result['data'] = pg_fetch_all(pg_query($dbconn, "SELECT * FROM notes ORDER BY id DESC;"));

  echo json_encode($result);
?>