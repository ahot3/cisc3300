<?php

$router->get('/', function () {
    include __DIR__ . '/../public/index.html';
});

$router->get('/products', 'ProductController@index');
$router->post('/products', 'ProductController@store');
$router->post('/products/update', 'ProductController@update');
$router->post('/products/delete', 'ProductController@delete');
