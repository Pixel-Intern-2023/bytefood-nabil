<?php

namespace app\Service;

require_once __DIR__ . "/../Exception/ValidationException.php";
require_once __DIR__ . "/../Model/Admin.php";
require_once __DIR__ . "/../Utility/DB.php";

use app\Exception\ValidationException;
use app\Model\Admin;
use app\Utility\DB;

class AdminService{


    public function register(Admin $admin): Admin
    {
        $this->validateRegisterAdmin($admin);
        DB::exec("INSERT INTO admin (username, name, email, password, registered_at) VALUES (?, ?, ?, ?, ?)", [
            $admin->username, $admin->name, $admin->email, $admin->password, $admin->registered_at
        ]);
        $admin->id = DB::lastInsertId();

        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
        $_SESSION["admin"] = true;
        $_SESSION["auth_id"] = $admin->id;

        return $admin;
    }

    private function validateRegisterAdmin(Admin $admin)
    {
        if(trim($admin->username) == "" || trim($admin->name) == "" || trim($admin->email) == "" || trim($admin->password) == "" || 
        $admin->username == null || $admin->name == null || $admin->email == null || $admin->password == null){
            throw new ValidationException("Value must not blank");
        }

        $statement = DB::exec("SELECT COUNT(id) as total FROM admin WHERE username IN(?) OR email IN(?)", [$admin->username, $admin->email]);
        $total = $statement->fetch()['total'];
        if ($total != 0){
            throw new ValidationException("email had been used");
        }
    }

    public function login(string $email, string $password): bool
    {
        $this->validateLoginAdmin($email, $password);
        $statement = DB::exec("SELECT COUNT(id) as total, id FROM admin WHERE email=? AND password=?", [
            $email, $password
        ]);
        if($row = $statement->fetch()){
            if($row['total'] == 1){
                session_start();
                $_SESSION["admin"] = true;
                $_SESSION["auth_id"] = $row['id'];
                return true;
            }
        }

        return false;
    }

    private function validateLoginAdmin(string $email, string $password)
    {
        if(trim($email) == "" || trim($password) == "" || $email == null || $password == null){
            throw new ValidationException("Please insert email and password to continue");
        }
    }

    public function get(string $id)
    {
        $statement = DB::exec("SELECT * FROM admin WHERE id=?",[$id]);

        $admin = new Admin();
        if($row = $statement->fetch()){
            $admin->id = $row['id'];
            $admin->username = $row['username'];
            $admin->name = $row['name'];
            $admin->email = $row['email'];
            $admin->password = $row['password'];
            $admin->registered_at = $row['registered_at'];
        }

        return $admin;
    }

    public function getAll(): array
    {
        $statement = DB::exec("SELECT * FROM admin");

        $admins = [];
        foreach($statement->fetchAll() as $row){
            $admin = new Admin();
            $admin->id = $row['id'];
            $admin->username = $row['username'];
            $admin->name = $row['name'];
            $admin->email = $row['email'];
            $admin->password = $row['password'];
            $admin->registered_at = $row['registered_at'];
            $admins[] = $admin;
        }

        return $admins;
    }
}