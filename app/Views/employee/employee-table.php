<?php require_once __DIR__ . $layouts[0]; ?>
<div class="row">
    <?php if (isset($model['error'])) { ?>
        <div class="alert alert-danger">
            <?= $model['error'] ?>
        </div>
    <?php } ?>
    <div class="d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">List Of Employee</h5>
                <a href="/add/employee" class="btn btn-primary">Add Employee</a>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Detail</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Employee Status</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Salary</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($model["employees"] as $employee) { ?>
                                <tr>
                                    <a href="#">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"><?= $index ?></h6>
                                        </td>
                                        <td class="border-bottom-0 d-flex align-items-center">
                                            <a href="/detail/employee/<?= $employee->id?>">
                                                <img style="height: 5rem; aspect-ratio: 1/1; object-fit: cover; <?= $employee->employee_status != "FIRED" ?: "filter: grayscale(100%);" ?>" src="./resources/images/employee/<?= $employee->image_profile ?>">
                                            </a>
                                            <div>
                                                <h6 class="fw-semibold mb-1"><?= $employee->name ?></h6>
                                                <span class="fw-normal"><?= $employee->occupation ?></span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal text-truncate" style="max-width: 200px;"><?= $employee->detail ?></p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="<?= $employee->employee_status != 'FIRED' ?: 'bg-danger' ?> badge bg-primary rounded-3 fw-semibold"><?= $employee->employee_status ?></span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 fs-4">IDR <?= number_format($employee->salary, 2, ',', '.') ?></h6>
                                        </td>
                                        <td>
                                            <?php
                                            if ($employee->employee_status != 'FIRED') {
                                            ?>
                                                <a class="btn btn-sm btn-dark" onclick="changeStatusVerify('fired',<?= $employee->id ?>)">Fired</a>
                                            <?php } else { ?>
                                                <a class="btn btn-sm btn-secondary" onclick="changeStatusVerify('hire',<?= $employee->id ?>)">Hire</a>
                                            <?php } ?>
                                            <a class="btn btn-sm btn-danger" onclick="deleteVerify(<?= $employee->id?>)">Delete</a>
                                            <a href="/edit/employee/<?= $employee->id ?>" class="class= btn btn-sm btn-warning">Edit</button>
                                        </td>
                                    </a>
                                </tr>
                            <?php $index++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= $mainURL?>/assets/js/sweetalert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
<?php require_once __DIR__ . $layouts[1]; ?>