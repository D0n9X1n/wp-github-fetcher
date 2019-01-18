<?php

include_once("funtions.php");

define("OK", 1);
define("NO_PARAM", 2);
define("NET_ERROR", 3);
define("PARSE_ERROR", 4);

$status_code = OK;

$title       = "";
$message     = "";
$content     = "";

if (empty($_POST['github_url'])) {
  $status_code = NO_PARAM;
  $message = "No Parameters - github_url";
  $content = "";
  goto OUTPUT;
} else {
  $github_url = $_POST['github_url'];
}

try {
  $content = @file_get_contents($github_url);
} catch(Exception $e) {
  $status_code = NET_ERROR;
  $message = $e->getMessage();
  $content = "";

  goto OUTPUT;
}

if (!preg_match("/<article.*?>([\s|\S]+)<\/article>/", $content, $matchers)) {
  $status_code = PARSE_ERROR;
  $message = "Parse ERROR - Github may change their pages or you are not in github address.";
  $content = "";
} else {
  $status_code = OK;
  $message = "Success!";
  $content = $matchers[0];

  // remove archer
  $content = preg_replace('/<a .*?class="anchor".*?>[\s|\S]+?<\/a>/', "", $content);

  if(preg_match("/<h\d+>([\s|\S]+?)<\/h\d+>/", $content, $matchers)) {
    $title = $matchers[1];
  }
  if (preg_match("/<p>([\s|\S]+)<\/p>/", $content, $matchers)) {
    $content = $matchers[1];
  }
}
goto OUTPUT;

//=====================================
//============= OUTPUT ================
//=====================================
OUTPUT:
$result['status_code'] = $status_code;
$result['message']     = $message;
$result['title']       = $title;
$result['content']     = $content;
dd($result);
