<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SICV | <?= $this->renderSection('titulo') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">

    <link href="<?= base_url() . '/css/main.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . '/css/micss.css' ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/DataTables/DataTables-1.10.23/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.css" />
</head>
<body>
    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: 50% 50% rgb(254, 254, 254);
            opacity: .8;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div class="loader">
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden"></span>
        </div>
    </div>
    
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

    <script src="<?= base_url('/js/jquery-3.5.1.min.js') ?>"></script>
    <script src="<?= base_url('/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>

    <script type="text/javascript" src="<?= base_url() . '/js/main.js' ?>"></script>
    <script>
        $('.dropdown-toggle').dropdown()
        $(window).ready(function() {
            $('.loader').hide();
        });
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