<?php
date_default_timezone_set('Asia/Manila');

error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('display_errors', 0);
ini_set('error_log', './logs.log');

session_start();

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
require_once 'controllers/AllowanceController.php';
require_once 'controllers/AthleteRatingController.php';
require_once 'controllers/FileResourceController.php';

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
$allowanceController = new AllowanceController();
$athleteRatingController = new AthleteRatingController();
$fileResourceController = new FileResourceController();

// dd
function dd(...$vars)
{
    // Get the debug backtrace
    $backtrace = debug_backtrace();

    // Get the file path and line number from where the function is called
    $filePath = $backtrace[0]['file'];
    $line = $backtrace[0]['line'];

    echo "<style>
    pre {
        background: #F8F9FA;
        border: 1px solid #E1E1E8;
        border-radius: 5px;
        padding: 10px;
        white-space: pre-wrap;
        word-wrap: break-word;
    }
    </style>";

    echo "<pre>";
    echo "Called in <strong>" . $filePath . "</strong> on line <strong>" . $line . "</strong>\n\n";

    // Loop through all passed variables and dump them with pretty print
    foreach ($vars as $var) {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        echo $output;
        // echo htmlspecialchars($output);
    }

    echo "</pre>";

    // Terminate the script
    die();
}

// Define routes
$routes = [
    '/index' => ['GET' => [$authenticateController, 'index']],
    '/about' => ['GET' => [$homeController, 'about']],
    '/sport' => ['GET' => [$homeController, 'sport']],
    '/contact' => ['GET' => [$homeController, 'contact']],
    '/faqs' => ['GET' => [$homeController, 'faqs']],
    '/login' => [
        'GET' => [$authenticateController, 'index'],
        'POST' => [$authenticateController, 'store'],
    ],
    '/terms' => ['GET' => [$homeController, 'terms']],
    '/register' => ['GET' => [$userController, 'index']],
    '/register/create' => ['POST' => [$userController, 'create']],
    '/forgot-password'=> [
        'GET' => [$authenticateController, 'forgot_password_index'],
        'POST' => [$authenticateController, 'forgot_pass_store']
    ],
    '/password-reset-validate' => [
        'GET' => [$authenticateController, 'password_reset_validate'],
        'POST' => [$authenticateController, 'password_reset_validate_store']
    ],

    // Admin
    '/admin/home' => ['GET' => [$adminHomeController, 'index']],
    '/admin/coordinators' => ['GET' => [$coordinatorController, 'index']],
    '/admin/coordinator-add' => [
        'GET' => [$coordinatorController, 'addnew'],
        'POST' => [$coordinatorController, 'create']
    ],
    '/admin/coordinator' => [
        'GET' => [$coordinatorController, 'show'],
        'POST' => [$coordinatorController, 'update']
    ],
    // '/admin/coordinator-update' => ['GET' => [$coordinatorController, 'update']],
    '/admin/manage-athlete' => ['GET' => [$athleteController, 'admin_index']],
    '/admin/allowance' => ['GET' => [$allowanceController, 'index']],
    '/admin/send-allowance-notice' => ['POST' => [$allowanceController, 'send_allowance_notice']],

    //Coordinator
    '/coordinator/home' => ['GET' => [$coordinatorHomeController, 'index']],
    '/coordinator/manage-athlete' => ['GET' => [$athleteController, 'index']],
    '/coordinator/athlete' => ['GET' => [$athleteController, 'show']],
    '/coordinator/athlete-approve' => ['POST' => [$athleteController, 'store']],
    '/coordinator/athlete-delete' => ['POST' => [$athleteController, 'delete']],
    '/coordinator/game-schedules' => ['GET' => [$gameScheduleController, 'index']],
    '/coordinator/game-schedules-create' => [
        'GET' => [$gameScheduleController, 'create'],
        'POST' => [$gameScheduleController, 'store']
    ],
    '/coordinator/game-schedule-delete' => ['POST' => [$gameScheduleController, 'delete']],
    '/coordinator/game-schedule' => [
        'GET' => [$gameScheduleController, 'show'],
        'POST' => [$gameScheduleController, 'update']
    ],
    '/coordinator/evaluations' => ['GET' => [$evaluationController, 'show']],
    '/coordinator/evaluations-approve-disapprove' => ['POST' => [$evaluationController, 'approve_disapprove']],
    '/coordinator/announcements' => ['GET' => [$announcementController, 'index']],
    '/coordinator/announcements-create' => [
        'GET' => [$announcementController, 'create'],
        'POST' => [$announcementController, 'store']
    ],
    '/coordinator/announcement' => ['GET' => [$announcementController, 'show']],
    '/coordinator/announcement-delete' => ['POST' => [$announcementController, 'delete']],
    '/coordinator/athlete-ratings' => ['GET' => [$athleteRatingController, 'index']],
    '/coordinator/athlete-rating' => ['GET' => [$athleteRatingController, 'show']],
    '/coordinator/athlete-rating-save' => ['POST' => [$athleteRatingController, 'store']],
    '/coordinator/file-resource' => [
        'GET' => [$fileResourceController, 'index'],
        'POST' => [$fileResourceController, 'upload']
    ],
    '/coordinator/file-delete' => ['POST' => [$fileResourceController, 'delete']],

    // Athlete
    '/athlete/home' => ['GET' => [$athleteHomeController, 'index']],
    '/athlete/submit-evaluation' => [
        'GET' => [$evaluationController, 'submit'],
        'POST' => [$evaluationController, 'submit_form']
    ],
    '/athlete/stat' => ['GET' => [$athleteRatingController, 'stat']],
    '/athlete/claim-allowance' => ['POST' => [$allowanceController, 'claim']],
    '/athlete/game-schedule' => ['GET' => [$gameScheduleController, 'schedule']],

    // Ajax API request
    '/coordinator/target-athlete' => ['POST' => [$athleteController, 'target_athlete']],

    // Logout
    '/logout' => ['GET' => [$authenticateController, 'logout']],
];

// Strip query string from URI
$uri = strtok($_SERVER['REQUEST_URI'], '?');
$uri = $uri === '/' ? '/index' : $uri;
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
