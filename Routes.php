<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/','StudentController::loginpage');
// $routes->post('/ValidationController', 'ValidationController::loginvalidate');
$routes->group('student', function ($routes){
    $routes->get('login','StudentController::loginpage');
    $routes->post('ValidationController', 'ValidationController::loginvalidate');
    $routes->get('adminview','StudentController::studentlist');
    $routes->get('delete/id/(:num)','StudentController::studentdelete/$1');
    $routes->get('add','StudentController::studentadd');
    $routes->post('insert','StudentController::studentinsert');
    $routes->get('edit/id/(:num)','StudentController::studentedit/$1');
    $routes->post('update/id/(:num)','StudentController::studentupdate/$1');
    $routes->get('view/id/(:num)','StudentController::studentview/$1');
});

