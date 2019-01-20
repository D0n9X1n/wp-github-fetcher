<?php
/*
Copyright © 2016 TangDongxin

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the "Software"),
to deal in the Software without restriction, including without limitation
the rights to use, copy, modify, merge, publish, distribute, sublicense,
and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

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
