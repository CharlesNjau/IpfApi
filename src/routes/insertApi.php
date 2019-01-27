<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/insertApi/{name}', function (Request $require,Response $response) {
    $name=$require->getAttribute('name');
    echo "This is  the name from the get  insert Api ".$name;
});



$app->run();