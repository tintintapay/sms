<?php
session_start();

require_once 'controllers/UserController.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/AuthenticateController.php';
require_once 'controllers/CoordinatorHomeController.php';
require_once 'controllers/AthleteHomeController.php';
require_once 'controllers/AdminHomeController.php';
require_once 'controllers/CoordinatorController.php';

// Define your controllers
$userController = new UserController();
$homeController = new HomeController();
$authenticateController = new AuthenticateController();
$coordinatorHomeController = new CoordinatorHomeController();
$athleteHomeController = new AthleteHomeController();
$adminHomeController = new AdminHomeController();
$coordinatorController = new CoordinatorController();

// Define routes
$routes = [
    '/sms/index' => ['GET' => [$homeController, 'index']],
    '/sms/about' => ['GET' => [$homeController, 'about']],
    '/sms/sport' => ['GET' => [$homeController, 'sport']],
    '/sms/contact' => ['GET' => [$homeController, 'contact']],
    '/sms/help' => ['GET' => [$homeController, 'help']],
    '/sms/login' => [
        'GET' => [$authenticateController, 'index'],
        'POST' => [$authenticateController, 'store'],
    ],
    '/sms/register' => ['GET' => [$userController, 'index']],
    '/sms/register/create' => ['POST' => [$userController, 'create']],

    // Admin
    '/sms/admin/home' => ['GET' => [$adminHomeController, 'index']],
    '/sms/admin/coordinators' => ['GET' => [$coordinatorController, 'index']],

    //Coordinator
    '/sms/coordinator/home' => ['GET' => [$coordinatorHomeController, 'index']],

    // Athlete
    '/sms/athlete/home' => ['GET' => [$athleteHomeController, 'index']],

    // Logout
    '/sms/logout' => ['GET' => [$authenticateController, 'logout']],

    // Testing
    '/sms/user' => ['GET' => [$userController, 'show']],
];

// Strip query string from URI
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$uri = $uri === '/sms/' ? '/sms/index' : $uri;
$method = $_SERVER['REQUEST_METHOD'];

// Match route
if (isset($routes[$uri][$method])) {
    // Get POST data for POST requests, otherwise use GET data
    $data = $method === 'POST' ? $_POST : $_GET;

    // Call the corresponding controller and pass the data
    call_user_func($routes[$uri][$method], $data);
} else {
    // Handle 404 - route not found
    http_response_code(404);
    echo "404 Not Found";
}
