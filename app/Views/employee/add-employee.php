<?php require_once __DIR__ . $layouts[0]; ?>
<div class="container">
    <?php if (isset($model['error'])) { ?>
        <div class="alert alert-danger">
            <?= $model['error'] ?>
        </div>
    <?php } ?>
    <form action="/add/employee" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label class="form-label">Occupation</label>
            <select name="occupation" class="form-select">
                <?php foreach ($model['occupations'] as $row) { ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php }; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Detail</label>
            <textarea name="detail" class="form-control" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Salary</label>
            <input type="number" class="form-control" name="salary">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="WORKING">Working</option>
                <option value="FIRED">Fired</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Image Profile</label>
            <input class="form-control" name="profile" type="file" id="formFile">
        </div>
        <button class="btn btn-primary" type="submit">Add</button>
    </form>
</div>
<script src="./assets/js/sweetalert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
<?php require_once __DIR__ . $layouts[1]; ?>