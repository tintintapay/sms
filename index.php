<?php
session_start();
date_default_timezone_set('Asia/Manila');

require_once 'controllers/UserController.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/AuthenticateController.php';
require_once 'controllers/CoordinatorHomeController.php';
require_once 'controllers/AthleteHomeController.php';
require_once 'controllers/AdminHomeController.php';
require_once 'controllers/CoordinatorController.php';
require_once 'controllers/AthleteController.php';
require_once 'controllers/GameScheduleController.php';
require_once 'controllers/EvaluationController.php';
require_once 'controllers/AnnouncementController.php';

// Define your controllers
$userController = new UserController();
$homeController = new HomeController();
$authenticateController = new AuthenticateController();
$coordinatorHomeController = new CoordinatorHomeController();
$athleteHomeController = new AthleteHomeController();
$adminHomeController = new AdminHomeController();
$coordinatorController = new CoordinatorController();
$athleteController = new AthleteController();
$gameScheduleController = new GameScheduleController();
$evaluationController = new EvaluationController();
$announcementController = new AnnouncementController();

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
    '/sms/admin/coordinator-add' => [
        'GET' => [$coordinatorController, 'addnew'],
        'POST' => [$coordinatorController, 'create']
    ],
    '/sms/admin/coordinator' => ['GET' => [$coordinatorController, 'show']],
    '/sms/admin/coordinator-update' => ['GET' => [$coordinatorController, 'update']],
    '/sms/admin/manage-athlete' => ['GET' => [$athleteController, 'admin_index']],

    //Coordinator
    '/sms/coordinator/home' => ['GET' => [$coordinatorHomeController, 'index']],
    '/sms/coordinator/manage-athlete' => ['GET' => [$athleteController, 'index']],
    '/sms/coordinator/athlete' => ['GET' => [$athleteController, 'show']],
    '/sms/coordinator/athlete-approve' => ['POST' => [$athleteController, 'store']],
    '/sms/coordinator/athlete-delete' => ['POST' => [$athleteController, 'delete']],
    '/sms/coordinator/game-schedules' => ['GET' => [$gameScheduleController, 'index']],
    '/sms/coordinator/game-schedules-create' => [
        'GET' => [$gameScheduleController, 'create'],
        'POST' => [$gameScheduleController, 'store']
    ],
    '/sms/coordinator/game-schedule-delete' => ['POST' => [$gameScheduleController, 'delete']],
    '/sms/coordinator/game-schedule' => [
        'GET' => [$gameScheduleController, 'show'],
        'POST' => [$gameScheduleController, 'update']
    ],
    '/sms/coordinator/evaluations' => ['GET' => [$evaluationController, 'show']],
    '/sms/coordinator/evaluations-approve-disapprove' => ['POST' => [$evaluationController, 'approve_disapprove']],
    '/sms/coordinator/announcements' => ['GET' => [$announcementController, 'index']],
    '/sms/coordinator/announcements-create' => [
        'GET' => [$announcementController, 'create'],
        'POST' => [$announcementController, 'store']
    ],
    '/sms/coordinator/announcement' => ['GET' => [$announcementController, 'show']],
    '/sms/coordinator/announcement-delete' => ['POST' => [$announcementController, 'delete']],

    // Athlete
    '/sms/athlete/home' => ['GET' => [$athleteHomeController, 'index']],
    '/sms/athlete/submit-evaluation' => [
        'GET' => [$evaluationController, 'submit'],
        'POST' => [$evaluationController, 'submit_form']
    ],

    // Ajax API request
    '/sms/coordinator/target-athlete' => ['POST' => [$athleteController, 'target_athlete']],

    // Logout
    '/sms/logout' => ['GET' => [$authenticateController, 'logout']],
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
    include 'views/404-not-found.html';
}
