<?php

$app->get('/fetchApi/{name}', function (Request $request, Response $response, array $args) {
     $name=$request->getParam('name');
    //echo "Test link working get data ".$name;
    echo $response;
});
//$app->run();
