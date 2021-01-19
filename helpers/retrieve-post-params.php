<?php
  function retrieve_post_params($post, $input) {
    //From Content-Type Multipart/Form-Data
    $params = $post;

    if($params == [] && $input != null && strlen(trim($input)) > 0) {
      $input = trim($input);
      
      if(substr($input, 0, 1) == '{') {
        //From Fetch Body JSON Stringify / From RAW POSTMAN
        $params = json_decode($input, true);
      } else {
        //From Content-Type x-www-urlencoded
        parse_str($input, $params);
      }
    }

    return $params;
  }
?>