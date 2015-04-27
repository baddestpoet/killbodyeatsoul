<?php
$route = new Zend_Controller_Router_Route(
    '/',
    array(
        'controller' => 'index',
        'action'     => 'index'
    ) 
);

$router->addRoute('/', $route);

$route = new Zend_Controller_Router_Route(
    '/stuff',
    array(
        'controller' => 'stuff',
        'action'     => 'index'
    ) 
);

$router->addRoute('stuff', $route);