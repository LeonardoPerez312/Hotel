<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/diaController.php");

use App\Controllers\DepartamentosController;
use App\Controllers\MunicipiosController;
use App\Controllers\UsuariosController;
use App\Models\GeneralFunctions;
use App\Models\Usuarios;
use Carbon\Carbon;

$nameModel = "Usuario";
$nameForm = 'frmEdit'.$nameModel;
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION[$nameForm] ?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $_ENV['TITLE_SITE']  ?> | Editar <?= $nameModel ?></title>
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
                        <h1>Editar <?= $nameModel ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= $baseURL; ?>/views/"><?= $_ENV['ALIASE_SITE'] ?></a></li>
                            <li class="breadcrumb-item"><a href="index.php"><?= $pluralModel ?></a></li>
                            <li class="breadcrumb-item active">Editar</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Generar Mensajes de alerta -->
            <?= (!empty($_GET['respuesta'])) ? GeneralFunctions::getAlertDialog($_GET['respuesta'], $_GET['mensaje']) : ""; ?>
            <?= (empty($_GET['id'])) ? GeneralFunctions::getAlertDialog('error', 'Faltan Criterios de Búsqueda') : ""; ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user"></i>&nbsp; Información del <?= $nameModel ?></h3>
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
                            <?php if (!empty($_GET["id"]) && isset($_GET["id"])) { ?>
                                <p>
                                <?php

                                $Datadia = diaController::searchForID(["id" => $_GET["id"]]);
                                /* @var $Datadia dia */
                                if (!empty($DataUsuario)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="<?= $nameForm ?>"
                                              name="<?= $nameForm ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $DataUsuario->getId(); ?>" hidden
                                                   required="required" type="text">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <div class="form-group row">
                                                        <label for="ingresos_idingresos" class="col-sm-2 col-form-label">Nombres ingreso</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="ingresos_idingresos"
                                                                   name="ingresos_idingresos" value="<?= $Datadia->getIngresoDia (); ?>"
                                                                   placeholder="Ingrese  Nombre Ingreso">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="habitaciones_idhabitaciones" class="col-sm-2 col-form-label">Gastos lavanderia</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" minlength="6" class="form-control"
                                                                   id="ingreso_dia" name="ingreso_dia"
                                                                   value="<?= $Datadia->getIngresoDia (); ?>"
                                                                   placeholder="Ingrese su documento">
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="turno" class="col-sm-2 col-form-label">Turno
                                                            Documento</label>
                                                        <div class="col-sm-10">
                                                            <select id="dia" name="turno"
                                                                    class="custom-select">
                                                                <option <?= ($Datadia->getTurno() == "dia") ? "selected" : ""; ?>
                                                                        value="Dia">Dia
                                                                </option>
                                                                <option <?= ($Datadia->getTurno() == "tarde") ? "selected" : ""; ?>
                                                                        value=tarde>Tarde
                                                                </option>
                                                                <option <?= ($Datadia->getTurno() == "noche") ? "selected" : ""; ?>
                                                                        value="noche">Noche
                                                                </option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <div class="form-group row">
                                                                <label for="nombres" class="col-sm-2 col-form-label">Personas</label>
                                                                <div class="col-sm-10">
                                                                    <input required type="text" class="form-control" id="nombres"
                                                                           name="nombres" value="<?= $Datadia->getNombres(); ?>"
                                                                           placeholder="Ingrese sus nombres">
                                                                </div>
                                                            </div>

                                                    <div class="form-group row">
                                                        <label for="fecha_nacimiento" class="col-sm-2 col-form-label">Fecha</label>
                                                        <div class="col-sm-10">
                                                            <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>"
                                                                   value="<?= $Datadia->getFecha()->toDateString(); ?>" class="form-control" id="fecha"
                                                                   name="fecha" placeholder="Ingrese la Fecha">








                                            <hr>
                                            <button id="frmName" name="frmName" value="<?= $nameForm ?>" type="submit" class="btn btn-info">Enviar</button>
                                            <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->

                                <?php } else { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                        No se encontro ningun registro con estos parametros de
                                        busqueda <?= ($_GET['mensaje']) ?? "" ?>
                                    </div>
                                <?php } ?>
                                </p>
                            <?php } ?>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->


</body>
</html>