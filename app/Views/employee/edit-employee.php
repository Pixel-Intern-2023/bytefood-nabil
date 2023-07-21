<?php require_once __DIR__ . $layouts[0];
$employee = $model['employee']; ?>
<div class="container">
    <?php if (isset($model['error'])) { ?>
        <div class="alert alert-danger">
            <?= $model['error'] ?>
        </div>
    <?php } ?>
    <form id="editEmployee" action="/edit/employee/<?= $employee->id ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $employee->id ?>">
        <input type="hidden" name="created_at" value="<?= $employee->created_at ?>">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" value="<?= $employee->name ?>" name="name">
        </div>
        <div class="mb-3">
            <label class="form-label">Occupation</label>
            <select name="occupation" class="form-select">
                <?php foreach ($model['occupations'] as $row) { ?>
                    <option <?= $row['id'] == $employee->id_occupation ?: "selected" ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php }; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Detail</label>
            <textarea name="detail" class="form-control" rows="5"><?= $employee->detail ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Salary</label>
            <input type="number" class="form-control" value="<?= $employee->salary ?>" name="salary">
        </div>
        <button class="btn btn-primary" onclick="saveChangesVerify('editEmployee')" type="button">Save Changes</button>
    </form>
    <form id="editProfile" class="mt-5" action="/edit/employee/profile/<?= $employee->id ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Image Profile</label>
            <input class="form-control" type="file" name="profile">
        </div>
        <button class="btn btn-primary" type="button" onclick="saveChangesVerify('editProfile')">Save Change</button>
    </form>
</div>
<script src="<?= $mainURL?>/assets/js/sweetalert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
<?php require_once __DIR__ . $layouts[1]; ?>