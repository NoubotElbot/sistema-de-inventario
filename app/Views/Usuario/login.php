<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SICV | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">

    <link href="<?= base_url() ?>/css/main.css" rel="stylesheet">

</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow closed-sidebar-mobile closed-sidebar">
        <div class="app-container closed-sidebar-mobile closed-sidebar">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="app-logo-inverse text-center mb-3"><img src="/images/logo.png" alt="" srcset=""></div>
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="h5 modal-title text-center">
                                        <h4 class="mt-2 mb-4">
                                            <div>Bienvenido,</div>
                                            <small>Inicie sesión en su cuenta a continuación.</small>
                                        </h4>
                                    </div>
                                    <?php if (isset($validation)) : ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $validation->listErrors() ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                    <form action="<?= base_url()."/" ?>" id="login" method="POST">
                                        <?= csrf_field() ?>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="username" id="username" placeholder="Nombre de usuario..." type="text" maxlength="50" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="password" id="password" placeholder="Contraseña..." type="password" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
                                        <label for="exampleCheck" class="form-check-label">Keep me logged in</label>
                                    </div> -->
                                    </form>
                                </div>
                                <div class="modal-footer clearfix">
                                    <div class="float-left"><a href="javascript:void(0);" class="btn-lg btn btn-link">Recuperar Contraseña</a></div>
                                    <div class="float-right">
                                        <button form="login" class="btn btn-primary btn-lg">Iniciar Sesión</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">Copyright © ArchitectUI 2019</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?= base_url() ?>/js/main.js"></script>
</body>

</html>