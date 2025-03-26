<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->options('(:any)', function () {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    http_response_code(200);
    exit();
});


$routes->group('departamento', function($routes){
    $routes->get("/", "DepartamentoController::index");
    $routes->get("show", "DepartamentoController::index");
    $routes->get("edit/(:num)", "DepartamentoController::singleDepartamento/$1");
    $routes->get("delete/(:num)", "DepartamentoController::delete/$1");
    $routes->post("add", "DepartamentoController::create");
    $routes->post("update", "DepartamentoController::update");
});

