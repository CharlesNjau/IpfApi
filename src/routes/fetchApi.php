<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//echo "All good";
 
//GET WEBSITES BY COMPANY BIO
$app->get('/fetchApi/{name}',function(Request $require,Response $response){

    $name=$require->getAttribute('name');
    echo "This is  the name from the get  fetchApi ".$name;
  });
//$app->run();
