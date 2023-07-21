<?php

namespace app\Service;

require_once __DIR__ . "/../Model/Employee.php";
require_once __DIR__ . "/../Model/EmployeeResponse.php";
require_once __DIR__ . "/../Utility/DB.php";
require_once __DIR__ . "/../Exception/SystemException.php";

use app\Exception\SystemException;
use app\Exception\ValidationException;
use app\Model\Employee;
use app\Model\EmployeeResponse;
use app\Utility\DB;

class EmployeeService{

    public function add(Employee $employee, $files = null): Employee
    {
        $this->validateAddEmployee($employee);
        $tmpFiles = $files['tmp_name'];
        $fileName = $files['name'];
        $targetPath = "resources/images/employee/" . $fileName;

        if(!file_exists($targetPath)){
            if(move_uploaded_file($tmpFiles, $targetPath)){
                DB::exec("INSERT INTO employee (name, id_occupation, detail, salary, created_at, updated_at, image_profile, employee_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [
                    $employee->name, $employee->id_occupation, $employee->detail, $employee->salary, $employee->created_at, $employee->updated_at, $fileName, $employee->employee_status
                ]);
                $employee->id = DB::lastInsertId();
            }else{
                throw new SystemException("System : Error, can't uploaded file");
            }
        }else{
            throw new SystemException("System : File is Exist");
        }
        return $employee;
    }

    private function validateAddEmployee(Employee $employee)
    {
        if(trim($employee->name) == "" || $employee->id_occupation == 0 || trim($employee->detail) == "" || $employee->salary == 0 || trim($employee->created_at) == "" || trim($employee->employee_status) == "" ||
        $employee->name == null || $employee->id_occupation == null || $employee->detail === null || $employee->salary == null || $employee->created_at == null || $employee->employee_status == null){
            throw new ValidationException("Value must not blank");
        }
    }

    public function get(string $id): Employee
    {
        $statement = DB::exec("SELECT * FROM employee WHERE id=?", [$id]);

        $employee = new Employee();
        if($row = $statement->fetch()){
            $employee->id = $row['id'];
            $employee->name = $row['name'];
            $employee->id_occupation = $row['id_occupation'];
            $employee->detail = $row['detail'];
            $employee->salary = $row['salary'];
            $employee->created_at = $row['created_at'];
            $employee->updated_at = $row['updated_at'];
            $employee->image_profile = $row['image_profile'];
            $employee->employee_status = $row['employee_status'];
        }

        return $employee;
    }

    public function getAll(): array
    {
        $statement = DB::exec("SELECT employee.id, employee.name, occupation.name as occupation, employee.detail, employee.salary, employee.created_at, employee.updated_at, employee.image_profile, employee.employee_status FROM employee JOIN occupation ON employee.id_occupation = occupation.id");

        $employees = [];
        foreach($statement->fetchAll() as $row){
            $employee = new EmployeeResponse();
            $employee->id = $row['id'];
            $employee->name = $row['name'];
            $employee->occupation = $row['occupation'];
            $employee->detail = $row['detail'];
            $employee->salary = $row['salary'];
            $employee->created_at = $row['created_at'];
            $employee->updated_at = $row['updated_at'];
            $employee->image_profile = $row['image_profile'];
            $employee->employee_status = $row['employee_status'];
            $employees[] = $employee;
        }

        return $employees;
    }

    public function edit(Employee $employee): Employee
    {
        $this->validateEditEmployee($employee);
        DB::exec("UPDATE employee SET name=?, id_occupation=?, detail=?, salary=?, created_at=?, updated_at=? WHERE id=?", [
            $employee->name, $employee->id_occupation, $employee->detail, $employee->salary, $employee->created_at, $employee->updated_at, $employee->id
        ]);

        return $employee;
    }

    private function validateEditEmployee(Employee $employee)
    {
        $statement = DB::exec("SELECT * FROM employee WHERE id=?", [$employee->id]);
        
        if($row = $statement->fetch()){
            if($employee->name == $row['name'] && $employee->id_occupation == $row['id_occupation'] && $employee->detail == $row['detail'] && $employee->salary == $row['salary']){
                throw  new ValidationException("Value must not same");
            }
        }else{
            throw new SystemException("System: Error get data");
        }
    }

    public function editProfile($file, string $id)
    {
        $tmpFiles = $file['tmp_name'];
        $fileName = $id . "-" .$file['name'];
        $dir = "resources/images/employee/";
        $targetPath = $dir . $fileName;

        if(!file_exists($targetPath)){
            if(move_uploaded_file($tmpFiles, $targetPath)){
                $pastImg = DB::exec("SELECT image_profile FROM employee WHERE id=?", [$id])->fetch()['image_profile'];
                unlink($dir . $pastImg);
                DB::exec("UPDATE employee SET image_profile = ? WHERE id=?", [$fileName, $id]);
            }else{
                throw new SystemException("System : Error, can't uploaded file");
            }
        }else{
            throw new SystemException("System : File is Exist");
        }
    }

    public function changeStatusEmployee(string $id, string $status)
    {
        DB::exec("UPDATE employee SET employee_status=? WHERE id=?", [$status, $id]);
    }
}