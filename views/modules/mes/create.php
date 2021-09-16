 <?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\DepartamentosController;
use App\Controllers\MunicipiosController;
use App\Models\GeneralFunctions;
use Carbon\Carbon;

$nameModel = "dia";
$nameForm = 'frmCreate'.$nameModel;
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION[$nameForm] ?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $_ENV['TITLE_SITE'] ?> | Crear <?= $nameModel ?></title>
    <?php require("../../partials/head_imports.php"); ?>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require("../../partials/navbar_customization.php"); ?>

    <?php require("../../partials/sliderbar_main_menu.php"); ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear un Nuevo <?= $nameModel ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/"><?= $_ENV['ALIASE_SITE'] ?></a></li>
                            <li class="breadcrumb-item"><a href="index.php"><?= $pluralModel ?></a></li>
                            <li class="breadcrumb-item active">Crear</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Generar Mensaje de alerta -->
            <?= (!empty($_GET['respuesta'])) ? GeneralFunctions::getAlertDialog($_GET['respuesta'], $_GET['mensaje']) : ""; ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user"></i> &nbsp; Información del <?= $nameModel ?></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                            data-source="create.php" data-source-selector="#card-refresh-content"
                                            data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                                class="fas fa-expand"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" id="<?= $nameForm ?>"
                                      name="<?= $nameForm ?>"
                                      action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=create">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group row">
                                                <label for="enero" class="col-sm-2 col-form-label">Enero</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="enero" name="enero"
                                                           placeholder="Mes" value="<?= $frmSession['enero'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="febrero" class="col-sm-2 col-form-label">Febrero</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="febrero"
                                                           name="febrero" placeholder=" Mes "
                                                           value="<?= $frmSession['febrero'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <div class="form-group row">
                                                        <label for="marzo" class="col-sm-2 col-form-label">Marzo</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="marzo" name="marzo"
                                                                   placeholder="Ingrese sus nombres" value="<?= $frmSession['marzo'] ?? '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="abril" class="col-sm-2 col-form-label">Abril</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="abril"
                                                                   name="abril" placeholder="Mes"
                                                                   value="<?= $frmSession['abril'] ?? '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <div class="form-group row">
                                                                <label for="mayo" class="col-sm-2 col-form-label">Mayo</label>
                                                                <div class="col-sm-10">
                                                                    <input required type="text" class="form-control" id="mayo" name="mayo"
                                                                           placeholder="Mes" value="<?= $frmSession['mayo'] ?? '' ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="julio" class="col-sm-2 col-form-label">Junio</label>
                                                                <div class="col-sm-10">
                                                                    <input required type="text" class="form-control" id="julio"
                                                                           name="julio" placeholder="Mes"
                                                                           value="<?= $frmSession['julio'] ?? '' ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-10">
                                                                    <div class="form-group row">
                                                                        <label for="julio" class="col-sm-2 col-form-label">Julio</label>
                                                                        <div class="col-sm-10">
                                                                            <input required type="text" class="form-control" id="julio" name="julio"
                                                                                   placeholder="Mes" value="<?= $frmSession['julio'] ?? '' ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="apellidos" class="col-sm-2 col-form-label">Agosto</label>
                                                                        <div class="col-sm-10">
                                                                            <input required type="text" class="form-control" id="apellidos"
                                                                                   name="apellidos" placeholder="Ingrese sus apellidos"
                                                                                   value="<?= $frmSession['apellidos'] ?? '' ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-10">
                                                                            <div class="form-group row">
                                                                                <label for="nombres" class="col-sm-2 col-form-label">Septiembre</label>
                                                                                <div class="col-sm-10">
                                                                                    <input required type="text" class="form-control" id="nombres" name="nombres"
                                                                                           placeholder="Ingrese sus nombres" value="<?= $frmSession['nombres'] ?? '' ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="octubre" class="col-sm-2 col-form-label">Octubre</label>
                                                                                <div class="col-sm-10">
                                                                                    <input required type="text" class="form-control" id="octubre"
                                                                                           name="octubre" placeholder="Ingrese sus apellidos"
                                                                                           value="<?= $frmSession['octubre'] ?? '' ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-10">
                                                                                    <div class="form-group row">
                                                                                        <label for="noviembre" class="col-sm-2 col-form-label">Noviembre</label>
                                                                                        <div class="col-sm-10">
                                                                                            <input required type="text" class="form-control" id="noviembre" name="noviembre"
                                                                                                   placeholder="Mes" value="<?= $frmSession['noviembre'] ?? '' ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label for="diciembre" class="col-sm-2 col-form-label">Diciembre</label>
                                                                                        <div class="col-sm-10">
                                                                                            <input required type="text" class="form-control" id="diciembre"
                                                                                                   name="diciembre" placeholder="Mes"
                                                                                                   value="<?= $frmSession['diciembre'] ?? '' ?>">
                                                                                        </div>
                                                                                    </div>




                                                            <!-- The file is stored here. -->
                                                            <input type="file" id="foto" name="foto">
                                                        </label>
                                                        <button type="button" class="btn btn-default">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <button id="frmName" name="frmName" value="<?= $nameForm ?>" type="submit" class="btn btn-info">Enviar</button>
                                    <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                    <!-- /.card-footer -->
                                </form>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require('../../partials/footer.php'); ?>
</div>
<!-- ./wrapper -->

</body>
</html>
