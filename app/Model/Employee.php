<?php

namespace app\Model;

class Employee{
    public int $id;
    public string $name;
    public int $id_occupation;
    public string $detail;
    public int $salary;
    public string $created_at;
    public ?string $updated_at = null;
    public string $image_profile;
    public string $employee_status;
}