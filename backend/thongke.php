<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div {
            border: 1px solid red;
        }
    </style>

    <?php
    include_once __DIR__ . '/layouts/style.php';
    ?>
</head>
<body>
    <?php
    include_once __DIR__ . '/layouts/header.php';
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
        <?php
        include_once __DIR__ . '/layouts/sidebar.php';
        ?>
            </div>
            <div class="col-md-9">
            THONG KE
            </div>
        </div>

    <?php
    include_once __DIR__ . '/layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/layouts/script.php';
    ?>
</body>
</html>