<?php

namespace app\Model;

class EmployeeResponse{
    public int $id;
    public string $name;
    public string $occupation;
    public string $detail;
    public int $salary;
    public string $created_at;
    public ?string $updated_at = null;
    public string $image_profile;
    public string $employee_status;
}