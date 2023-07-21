<?php require_once __DIR__ . $layouts[0]; ?>
<div class="row">
    <div class="d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">List Of Employee</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Email</h6>
                                </th>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Resgitered at</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($model["admins"] as $admin) { ?>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0"><?= $index ?></h6>
                                    </td>
                                    <td class="border-bottom-0 d-flex align-items-center">
                                        <div>
                                            <h6 class="fw-semibold mb-1"><?= $admin->name ?></h6>
                                            <span class="fw-normal"><?= $admin->username ?></span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $admin->email ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $admin->registered_at ?></p>
                                    </td>
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
<?php require_once __DIR__ . $layouts[1]; ?>