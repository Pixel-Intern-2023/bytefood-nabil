<?php

namespace app\Controller;

require_once __DIR__ . "/../App/View.php";
require_once __DIR__ . "/../Model/Admin.php";
require_once __DIR__ . "/../Service/AdminService.php";
require_once __DIR__ . "/../Utility/Allert.php";

use Allert;
use app\App\View;
use app\Model\Admin;
use app\Service\AdminService;
use Exception;

class AuthController{
    
    private AdminService $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService();
    }
    
    public function register()
    {
        View::returnView("/auth/register", [
            "title" => "Register Admin",
        ]);
    }

    public function doRegister()
    {
        $admin = new Admin();
        $admin->name = $_POST['name'];
        $admin->username = $_POST['username'];
        $admin->email = $_POST['email'];
        $admin->password = $_POST['password'];
        $admin->registered_at = date('Y-m-d H:i:s');
        try{
            $admin = $this->adminService->register($admin);
            Allert::set("Success Register", "Loggined as $admin->name");
            View::redirect("/");
        }catch(Exception $e){
            View::returnView("/auth/register", [
                "title" => "Register Admin",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function login()
    {
        View::returnView("/auth/login", [
            "title" => "Login Admin",
        ]);
    }

    public function doLogin()
    {
        try{
            if($this->adminService->login($_POST['email'], $_POST['password'])){
                View::redirect("/");
            }
            View::returnView("/auth/login", [
                "title" => "Login Admin",
                "error" => "Username or password is wrong"
            ]);
        }catch(Exception $e){
            View::returnView("/auth/login", [
                "title" => "Login Admin",
                "error" => $e
            ]);
        }
    }

    public function doLogout()
    {
        session_destroy();
        View::redirect("/login");
    }
}