<?php

namespace app\Controller;

require_once __DIR__ . "/../App/View.php";
require_once __DIR__ . "/../Service/EmployeeService.php";
require_once __DIR__ . "/../Utility/Allert.php";

use Allert;
use app\App\View;
use app\Model\Employee;
use app\Service\EmployeeService;
use app\Utility\DB;
use Exception;

class EmployeeController{

    private EmployeeService $employeeService;

    public function __construct(){
        $this->employeeService = new EmployeeService();
    }

    public function main()
    {
        View::returnView('/employee/employee-table', [
            "title" => "List Of Employee",
            "employees" => $this->employeeService->getAll(),
            "occupations" => DB::exec("SELECT * FROM occupation")->fetchAll()
        ]);
        Allert::get();
    }

    public function detail(string $id)
    {
        $employee = $this->employeeService->get($id);
        View::returnView("/employee/detail-employee",[
            "title" => "Detail",
            "employee" => $employee,
            "occupation" => DB::exec("SELECT name FROM occupation WHERE id=?", [$employee->id_occupation])->fetch()['name']
        ]);
    }

    public function addEmployee()
    {
        View::returnView("/employee/add-employee", [
            "title" => "Add Employee",
            "occupations" => DB::exec("SELECT * FROM occupation")->fetchAll(),
            "status" => ['WORKING', 'FIRED'],
        ]);
    }

    public function doAddEmployee()
    {
        $employee = new Employee();
        $employee->name = $_POST['name'];
        $employee->id_occupation = $_POST['occupation'];
        $employee->detail = $_POST['detail'];
        $employee->salary = (int)$_POST['salary'];
        $employee->created_at = date("Y-m-d H:i:s");
        $employee->image_profile = $_FILES['profile']['name'];
        $employee->employee_status = $_POST['status'];
        try{
            $employee = $this->employeeService->add($employee, $_FILES['profile']);
            Allert::set("Success!", "Success add data ".$employee->name);
            View::redirect("/employees");
        }catch(Exception $e){
            View::returnView("/employee/employee-table", [
                "title" => "Table Employee",
                "employees" => $this->employeeService->getAll(),
                "occupations" => DB::exec("SELECT * FROM occupation")->fetchAll(),
                "status" => ['WORKING', 'FIRED'],
                "error" => $e->getMessage()
            ]);
        }
    }
    
    public function editEmployee(string $id)
    {
        View::returnView("/employee/edit-employee", [
            "title" => "Edit Employee",
            "employee" => $this->employeeService->get($id),
            "occupations" => DB::exec("SELECT * FROM occupation")->fetchAll(),
            "status" => ['WORKING', 'FIRED'],
        ]);
    }

    public function doEditEmployee()
    {
        $employee = new Employee();
        $employee->id = $_POST['id'];
        $employee->name = $_POST['name'];
        $employee->id_occupation = $_POST['occupation'];
        $employee->detail = $_POST['detail'];
        $employee->salary = (int)$_POST['salary'];
        $employee->created_at = $_POST['created_at'];
        $employee->updated_at = date("Y-m-d H:i:s");
        
        try{
            $employee = $this->employeeService->edit($employee);
            Allert::set("Success!", "Success Edit data ".$employee->name);
            View::redirect("/employees");
        }catch(Exception $e){
            View::returnView("/employee/edit-employee", [
                "title" => "Edit Employee",
                "employee" => $this->employeeService->get($employee->id),
                "occupations" => DB::exec("SELECT * FROM occupation")->fetchAll(),
                "error" => $e->getMessage()
            ]);
        }
    }

    public function doEditProfileEmployee(string $id)
    {
        try{
            $this->employeeService->editProfile($_FILES['profile'], $id);
            Allert::set("Success!", "Success Edit Profile");
            View::redirect("/employees");
        }catch(Exception $e){
            View::returnView("/employee/edit-employee", [
                "title" => "Edit Employee",
                "employee" => $this->employeeService->get($id),
                "occupations" => DB::exec("SELECT * FROM occupation")->fetchAll(),
                "error" => $e->getMessage()
            ]);
        }
    }

    public function doDeleteEmployee(string $id)
    {
        DB::exec("DELETE FROM employee WHERE id=?", [$id]);
        $employee = DB::findById('employee', (int)$id);
        Allert::set("Success!", "Success Deleted data ".$employee['name']);
            View::redirect("/employees");
    }

    public function doFireEmployee(string $id)
    {
        $this->employeeService->changeStatusEmployee($id, "FIRED");
        $employee = DB::findById('employee', (int)$id);
            Allert::set("Success!", "Success fired employee ".$employee['name']);
            View::redirect("/employees");
    }

    public function doHireEmployee(string $id)
    {
        $this->employeeService->changeStatusEmployee($id, "WORKING");
        $employee = DB::findById('employee', (int)$id);
        Allert::set("Success!", "Success Hired employee ".$employee['name']);
        View::redirect("/employees");
    }
}