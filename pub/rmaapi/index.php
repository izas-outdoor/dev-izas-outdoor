<?php
require __DIR__ . "/inc/bootstrap.php";
 
$uri = parse_url($_SERVER['REQUEST_URI']);
//$uri = explode( '/', $uri );
parse_str($uri['query'], $params);


if (!isset($params['from']) && !isset($params['to'])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
 
require PROJECT_ROOT_PATH . "/Controller/Api/RmaController.php";
 
$objFeedController = new RmaController();
$strMethodName = 'listAction';
$objFeedController->{$strMethodName}();
?>