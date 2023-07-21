<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="<?= $mainURL?>/assets/js/sweetalert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<?php
require_once __DIR__ . "/../app/Utility/Allert.php";
Allert::set("Succes", "Success Add Data Employee");
Allert::get();
?>
</body>
</html>