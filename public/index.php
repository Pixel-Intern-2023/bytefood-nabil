<?php

require_once __DIR__ . "/../app/App/Router.php";
require_once __DIR__ . "/../app/Middlewares/Middleware.php";
require_once __DIR__ . "/../app/Controllers/EmployeeController.php";
require_once __DIR__ . "/../app/Controllers/AuthController.php";
require_once __DIR__ . "/../app/Controllers/AdminController.php";
require_once __DIR__ . "/../app/Controllers/DashboardController.php";
require_once __DIR__ . "/../app/Middlewares/MustLoginMiddleware.php";
require_once __DIR__ . "/../app/Middlewares/MustNotLoginMiddleware.php";

use app\App\Router;
use app\Controller\AdminController;
use app\Controller\AuthController;
use app\Controller\DashboardController;
use app\Controller\EmployeeController;
// use app\Middlewares\Middleware;
use app\Middlewares\MustLoginMiddleware;
use app\Middlewares\MustNotLoginMiddleware;

Router::add("GET", "/", DashboardController::class, 'main', [MustLoginMiddleware::class]);

Router::add("GET", "/employees", EmployeeController::class, 'main', [MustLoginMiddleware::class]);
Router::add("GET", "/detail/employee/([0-9]+)", EmployeeController::class, 'detail', [MustLoginMiddleware::class]);
Router::add("GET", "/add/employee", EmployeeController::class, 'addEmployee', [MustLoginMiddleware::class]);
Router::add("POST", "/add/employee", EmployeeController::class, 'doAddEmployee', [MustLoginMiddleware::class]);
Router::add("GET", "/edit/employee/([0-9]+)", EmployeeController::class, 'editEmployee', [MustLoginMiddleware::class]);
Router::add("POST", "/edit/employee/([0-9]+)", EmployeeController::class, 'doEditEmployee', [MustLoginMiddleware::class]);
Router::add("POST", "/edit/employee/profile/([0-9]+)", EmployeeController::class, 'doEditProfileEmployee', [MustLoginMiddleware::class]);
Router::add("GET", "/delete/employee/([0-9]+)", EmployeeController::class, 'doDeleteEmployee', [MustLoginMiddleware::class]);
Router::add("GET", "/fired/employee/([0-9]+)", EmployeeController::class, 'doFireEmployee', [MustLoginMiddleware::class]);
Router::add("GET", "/hire/employee/([0-9]+)", EmployeeController::class, 'doHireEmployee', [MustLoginMiddleware::class]);

Router::add("GET", "/admins", AdminController::class, 'listadmin', [MustLoginMiddleware::class]);

Router::add("GET", "/register", AuthController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add("POST", "/register", AuthController::class, 'doRegister', [MustNotLoginMiddleware::class]);
Router::add("GET", "/login", AuthController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add("POST", "/login", AuthController::class, 'doLogin', [MustNotLoginMiddleware::class]);

Router::add("GET", "/logout", AuthController::class, 'doLogout', [MustLoginMiddleware::class]);

Router::run();