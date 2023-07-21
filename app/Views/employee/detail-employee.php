<?php 
require_once __DIR__ . $layouts[0];
$employee = $model['employee']; ?>
<div class="container">
    <h1 class="mb-5">Detail Of <?= $employee->name?></h1>
    <div class="mb-3">
        <h5>Name</h5>
        <p><?= $employee->name?></p>
    </div>
    <div class="mb-3">
        <h5>Occupation</h5>
        <p><?= $model['occupation']?></p>
    </div>
    <div class="mb-3">
        <h5>Detail</h5>
        <p><?= $employee->detail?></p>
    </div>
    <div class="mb-3">
        <h5>Employee Status</h5>
        <p><?= $employee->employee_status?></p>
    </div>
    <div class="mb-3">
        <h5>Employee Salary</h5>
        <p><?= $employee->salary?></p>
    </div>
    <div class="mb-3">
        <h5>Created At</h5>
        <p><?= $employee->created_at?></p>
    </div>
    <div class="mb-3">
        <h5>Last Update</h5>
        <p><?= $employee->updated_at?></p>
    </div>
</div>
<?php require_once __DIR__ . $layouts[0];?>