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
                        /*<?php if ($_SESSION['UserInSession']['rol'] == 'Administrador'){ ?>/*
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
                                        <div class="form-group row">
                                            <label for="dia" class="col-sm-2 col-form-label">Ingreso del Dia</label>
                                            <div class="col-sm-10">
                                                <input required type="number" minlength="6" class="form-control"
                                                       id="ingreso_dia" name="ingreso_dia" placeholder="Ingresos del Dia"
                                                       value="<?= $frmSession['documento'] ?? '' ?>">
                                            </div>

                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <label for="nombres" class="col-sm-2 col-form-label">Nombre ingreaso</label>
                                                    <div class="col-sm-10">
                                                        <input required type="text" class="form-control" id="nombres" name="nombres"
                                                               placeholder="Ingrese sus nombres" value="<?= $frmSession['nombres'] ?? '' ?>">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                                                <div class="col-sm-10">
                                                    <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>" class="form-control" id="fecha"
                                                           name="fecha" placeholder="Ingrese la Fecha"
                                                           value="<?= $frmSession['fecha'] ?? '' ?>">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="tipo_documento" class="col-sm-2 col-form-label">
                                                    Turno</label>
                                                <div class="col-sm-10">
                                                    <select id="tipo_documento" name="tipo_documento" class="custom-select">
                                                        <option <?= (!empty($frmSession['turno']) && $frmSession['turno'] == "dia") ? "selected" : ""; ?> value="Dia">Dia</option>
                                                        <option <?= (!empty($frmSession['turno']) && $frmSession['turno'] == "tarde") ? "selected" : ""; ?> value="Tarde">Tarde</option>
                                                        <option <?= (!empty($frmSession['turno']) && $frmSession['turno'] == "noche") ? "selected" : ""; ?> value="Noche">Noche</option>
                                                    </select>
                                                </div>
                                            </div>




                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <label for="nombres" class="col-sm-2 col-form-label">Persona</label>
                                                    <div class="col-sm-10">
                                                        <input required type="text" class="form-control" id="nombres" name="nombres"
                                                               placeholder="Ingrese sus nombres" value="<?= $frmSession['nombres'] ?? '' ?>">
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label for="categoria_id" class="col-sm-2 col-form-label">Categoria</label>
                                                    <div class="col-sm-10 ">
                                                        <?= mesController::selectmes(
                                                            array(
                                                                'id' => 'Mes_idMes',
                                                                'name' => 'Mes_idMes',
                                                                'defaultValue' => (!empty($frmSession['Mes_idMes'])) ? $frmSession['Mes_idMes'] : '',
                                                                'class' => 'form-control select2bs4 select2-info',
                                                                'where' => "estado = 'Activo'"
                                                            )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="ingresos_id" class="col-sm-2 col-form-label">Categoria</label>
                                                    <div class="col-sm-10 ">
                                                        <?= CategoriasController::selectCategoria(
                                                            array(
                                                                'id' => 'ingresos_id',
                                                                'name' => 'ingresos_id',
                                                                'defaultValue' => (!empty($frmSession['ingresos_id'])) ? $frmSession['ingresos_id'] : '',
                                                                'class' => 'form-control select2bs4 select2-info',
                                                                'where' => "estado = 'Activo'"
                                                            )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="estado" class="col-sm-2 col-form-label">Estado</label>

                                                </div>
                                            <?php } ?>
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
