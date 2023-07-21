<?php

namespace app\Controller;

require_once __DIR__ . "/../App/View.php";
require_once __DIR__ . "/../Model/Admin.php";
require_once __DIR__ . "/../Service/AdminService.php";

use app\App\View;
use app\Model\Admin;
use app\Service\AdminService;
use Exception;

class AdminController{

    private AdminService $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService();
    }

    public function dashboard()
    {
        View::returnView("/admin/index",[
            "title" => "Dashboard"
        ]);
    }

    public function listadmin()
    {
        View::returnView("/admin/admin-table", [
            "title" => "List Admin",
            "admins" => $this->adminService->getAll()
        ]);
    }

}