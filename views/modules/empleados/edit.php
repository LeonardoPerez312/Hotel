<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/empleadosController.php");

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

                                $Dataempleados = empleadosController::searchForID(["id" => $_GET["id"]]);
                                /* @var $Dataempleados empleados */
                                if (!empty($Dataempleados)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="<?= $nameForm ?>"
                                              name="<?= $nameForm ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $Dataempleados->getId(); ?>" hidden
                                                   required="required" type="text">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <div class="form-group row">
                                                        <label for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="nombres"
                                                                   name="nombres" value="<?= $Dataempleados->getNombres(); ?>"
                                                                   placeholder="Ingrese sus nombres">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="apellidos"
                                                                   name="apellidos" value="<?= $Dataempleados->getApellidos(); ?>"
                                                                   placeholder="Ingrese sus apellidos">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="tipo_documento" class="col-sm-2 col-form-label">Tipo
                                                            Documento</label>
                                                        <div class="col-sm-10">
                                                            <select id="tipo_documento" name="tipo_documento"
                                                                    class="custom-select">
                                                                <option <?= ($Dataempleados->getTipoDocumento() == "C.C") ? "selected" : ""; ?>
                                                                        value="C.C">Cedula de Ciudadania
                                                                </option>
                                                                <option <?= ($Dataempleados->getTipoDocumento() == "T.I") ? "selected" : ""; ?>
                                                                        value="T.I">Tarjeta de Identidad
                                                                </option>
                                                                <option <?= ($Dataempleados->getTipoDocumento() == "R.C") ? "selected" : ""; ?>
                                                                        value="R.C">Registro Civil
                                                                </option>
                                                                <option <?= ($Dataempleados->getTipoDocumento() == "Pasaporte") ? "selected" : ""; ?>
                                                                        value="Pasaporte">Pasaporte
                                                                </option>
                                                                <option <?= ($Dataempleados->getTipoDocumento() == "C.E") ? "selected" : ""; ?>
                                                                        value="C.E">Cedula de Extranjeria
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="numero_cedula" class="col-sm-2 col-form-label">Documento</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" minlength="6" class="form-control"
                                                                   id="numero_cedula" name="numero_cedula"
                                                                   value="<?= $Dataempleados->getTipoDocumento(); ?>"
                                                                   placeholder="Ingrese su documento">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="celular" class="col-sm-2 col-form-label">Celular</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" minlength="6" class="form-control"
                                                                   id="celular" name="celular"
                                                                   value="<?= $Dataempleados->getCelular(); ?>"
                                                                   placeholder="Ingrese su telefono">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="salario" class="col-sm-2 col-form-label">Salario</label>
                                                        <div class="col-sm-10">
                                                            <input required type="number" minlength="6" class="form-control"
                                                                   id="salario" name="salario"
                                                                   value="<?= $Dataempleados->getSalario(); ?>"
                                                                   placeholder="Ingrese su telefono">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="direccion"
                                                                   name="direccion" value="<?= $Dataempleados->getDireccion(); ?>"
                                                                   placeholder="Ingrese su direccion">
                                                        </div>
                                                    </div>



                                                        <div class="form-group row">
                                                            <label for="cargo" class="col-sm-2 col-form-label">Cargo</label>
                                                            <div class="col-sm-10">
                                                                <input required type="text" class="form-control" id="cargo"
                                                                       name="cargo" value="<?= $Dataempleados->getCargo(); ?>"
                                                                       placeholder="Ingrese la ciudad">
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
