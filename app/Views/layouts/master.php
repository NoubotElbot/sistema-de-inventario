<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $this->renderSection('titulo') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="<?= base_url() . '/css/main.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . '/css/micss.css' ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/DataTables/DataTables-1.10.23/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.css" />

</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?= $this->include('layouts/header') ?>
        <div class="app-main">
            <?= $this->include('layouts/sidebar') ?>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <?= $this->renderSection('contenido') ?>
                </div>
                <?= $this->include('layouts/footer') ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script> <!-- <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script type="text/javascript" src="<?= base_url() . '/js/main.js' ?>"></script>
    <script>
        $('.dropdown-toggle').dropdown()
    </script>
    <script type="text/javascript" src="<?= base_url() ?>/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/DataTables/DataTables-1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/DataTables/DataTables-1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/DataTables/Buttons-1.6.5/js/buttons.html5.min.js"></script>
    <?= $this->renderSection('scripts') ?>

    <?= $this->renderSection('modals') ?>

</body>

</html>