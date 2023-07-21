<?php

namespace app\Controller;

require_once __DIR__ . "/../App/View.php";
require_once __DIR__ . "/../Utility/DB.php";
require_once __DIR__ . "/../Utility/Allert.php";

use Allert;
use app\App\View;
use app\Utility\DB;

class DashboardController{

    public function main()
    {
        View::returnView("/dashboard/index", [
            "title" => "Dashboard",
            "total_admin" => DB::exec("SELECT COUNT(id) as id FROM admin")->fetch()['id'],
            "total_employee" => DB::exec("SELECT COUNT(id) as id FROM employee")->fetch()['id'],
        ]);
        Allert::get();
    }
}