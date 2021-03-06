<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/clientesController.php");

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
            <?= (empty($_GET['id'])) ? GeneralFunctions::getAlertDialog('error', 'Faltan Criterios de B??squeda') : ""; ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user"></i>&nbsp; Informaci??n del <?= $nameModel ?></h3>
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

                                $Dataclientes = clientesController::searchForID(["id" => $_GET["id"]]);
                                /* @var $Dataclientes clientes */
                                if (!empty($Dataclientes)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="<?= $nameForm ?>"
                                              name="<?= $nameForm ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $Dataclientes->getId(); ?>" hidden
                                                   required="required" type="text">
                                            <div class="form-group row">
                                                <label for="documento" class="col-sm-2 col-form-label">Ingreso Dia</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" minlength="6" class="form-control"
                                                           id="documento" name="documento"
                                                           value="<?= $Dataclientes->getDocumento(); ?>"
                                                           placeholder="Ingrese su documento">
                                                </div>
                                            </div>
                                                    <div class="form-group row">
                                                        <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="apellidos"
                                                                   name="apellidos" value="<?= $Dataclientes->getApellidos(); ?>"
                                                                   placeholder="Ingrese sus apellidos">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="tipo_documento" class="col-sm-2 col-form-label">Tipo
                                                            Documento</label>
                                                        <div class="col-sm-10">
                                                            <select id="tipo_documento" name="tipo_documento"
                                                                    class="custom-select">
                                                                <option <?= ($Dataclientes->getTipoDocumento() == "C.C") ? "selected" : ""; ?>
                                                                        value="C.C">Cedula de Ciudadania
                                                                </option>
                                                                <option <?= ($Dataclientes->getTipoDocumento() == "T.I") ? "selected" : ""; ?>
                                                                        value="T.I">Tarjeta de Identidad
                                                                </option>
                                                                <option <?= ($Dataclientes->getTipoDocumento() == "R.C") ? "selected" : ""; ?>
                                                                        value="R.C">Registro Civil
                                                                </option>
                                                                <option <?= ($Dataclientes->getTipoDocumento() == "Pasaporte") ? "selected" : ""; ?>
                                                                        value="Pasaporte">Pasaporte
                                                                </option>
                                                                <option <?= ($Dataclientes->getTipoDocumento() == "C.E") ? "selected" : ""; ?>
                                                                        value="C.E">Cedula de Extranjeria
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="documento" class="col-sm-2 col-form-label">Documento</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" minlength="6" class="form-control"
                                                                   id="documento" name="documento"
                                                                   value="<?= $Dataclientes->getDocumento(); ?>"
                                                                   placeholder="Ingrese su documento">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="telefono" class="col-sm-2 col-form-label">Celular</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" minlength="6" class="form-control"
                                                                   id="Celular" name="Celular"
                                                                   value="<?= $Dataclientes->getCelular(); ?>"
                                                                   placeholder="Ingrese su telefono">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="direccion"
                                                                   name="direccion" value="<?= $Dataclientes->getDireccion(); ?>"
                                                                   placeholder="Ingrese su direccion">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                                                        <div class="col-sm-10">
                                                            <input required type="date" max="<?= Carbon::now()->subYear(12)->format('Y-m-d') ?>"
                                                                   value="<?= $Dataclientes->getFecha()->toDateString(); ?>" class="form-control" id="fecha_nacimiento"
                                                                   name="fecha" placeholder="Ingrese su Fecha de Nacimiento">
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="ciudad" class="col-sm-2 col-form-label">Ciuadad</label>
                                                            <div class="col-sm-10">
                                                                <input required type="text" class="form-control" id="apellidos"
                                                                       name="Ciudad" value="<?= $Dataclientes->getCiudad(); ?>"
                                                                       placeholder="Ingrese sus apellidos">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="hora" class="col-sm-2 col-form-label">Hora</label>
                                                            <div class="col-sm-10">
                                                                <input required type="date" max="<?= Carbon::now()->subYear(12)->format('d-h') ?>"
                                                                       value="<?= $Dataclientes->getFecha()->toDateString(); ?>" class="form-control" id="fecha_nacimiento"
                                                                       name="fecha" placeholder="Ingrese su Fecha">
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="habitaciones_idhabitaciones" class="col-sm-2 col-form-label">Gastos lavanderia</label>
                                                                <div class="col-sm-10">
                                                                    <input required type="number" minlength="6" class="form-control"
                                                                           id="getHabitacionesIdhabitaciones" name="habitaciones_idhabitaciones"
                                                                           value="<?= $Dataclientes->getHabitacionesIdhabitaciones(); ?>"
                                                                           placeholder="Ingrese su documento">
                                                                </div>
                                                            </div>




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
