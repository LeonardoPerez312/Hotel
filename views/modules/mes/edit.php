<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");
require("../../../app/Controllers/UsuariosController.php");

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

                                $Datames = mesController::searchForID(["id" => $_GET["id"]]);
                                /* @var $Datames mes */
                                if (!empty($Datames)) {
                                    ?>
                                    <!-- form start -->
                                    <div class="card-body">
                                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="<?= $nameForm ?>"
                                              name="<?= $nameForm ?>"
                                              action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=edit">
                                            <input id="id" name="id" value="<?= $Datames->getId(); ?>" hidden
                                                   required="required" type="text">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <div class="form-group row">
                                                        <label for="enero" class="col-sm-2 col-form-label">Enero</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="enero"
                                                                   name="enero" value="<?= $Datames->getEnero(); ?>"
                                                                   placeholder="Ingrese sus nombres">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="febrero" class="col-sm-2 col-form-label">Febrero</label>
                                                        <div class="col-sm-10">
                                                            <input required type="text" class="form-control" id="febrero"
                                                                   name="febrero" value="<?= $Datames->getFebrero(); ?>"
                                                                   placeholder="Mes">
                                                        </div>

                                                        <div class="col-sm-10">
                                                            <div class="form-group row">
                                                                <label for="marzo" class="col-sm-2 col-form-label">Marzo</label>
                                                                <div class="col-sm-10">
                                                                    <input required type="text" class="form-control" id="marzo"
                                                                           name="marzo" value="<?= $Datames->getMarzo(); ?>"
                                                                           placeholder="Mes">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="abril" class="col-sm-2 col-form-label">Abril</label>
                                                                <div class="col-sm-10">
                                                                    <input required type="text" class="form-control" id="abril"
                                                                           name="abril" value="<?= $Datames->getAbril(); ?>"
                                                                           placeholder="Mes">
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <div class="form-group row">
                                                                        <label for="mayo" class="col-sm-2 col-form-label">Mayo</label>
                                                                        <div class="col-sm-10">
                                                                            <input required type="text" class="form-control" id="mayo"
                                                                                   name="mayo" value="<?= $Datames->getMayo(); ?>"
                                                                                   placeholder="Mes">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="junio" class="col-sm-2 col-form-label">Junio</label>
                                                                        <div class="col-sm-10">
                                                                            <input required type="text" class="form-control" id="junio"
                                                                                   name="junio" value="<?= $Datames->getJunio(); ?>"
                                                                                   placeholder="Mes">
                                                                        </div>


                                                                            <div class="form-group row">

                                                                                <label for="julio" class="col-sm-2 col-form-label">Julio</label>
                                                                                <div class="col-sm-10">
                                                                                    <input required type="text" class="form-control" id="julio"
                                                                                           name="julio" value="<?= $Datames->getJulio(); ?>"
                                                                                           placeholder="Mes">
                                                                                </div>
                                                                            </div>


                                                                            <div class="form-group row">
                                                                                <label for="agosto" class="col-sm-2 col-form-label">Agosto</label>
                                                                                <div class="col-sm-10">
                                                                                    <input required type="text" class="form-control" id="agosto"
                                                                                           name="agosto" value="<?= $Datames->getAgosto(); ?>"
                                                                                           placeholder="Mes">
                                                                                </div>


                                                                                <div class="col-sm-10">
                                                                                    <div class="form-group row">
                                                                                        <label for="septiembre" class="col-sm-2 col-form-label">Septiembre</label>
                                                                                        <div class="col-sm-10">
                                                                                            <input required type="text" class="form-control" id="septiembre"
                                                                                                   name="septiembre" value="<?= $Datames->getSeptiembre(); ?>"
                                                                                                   placeholder="Mes">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group row">
                                                                                        <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                                                                                        <div class="col-sm-10">
                                                                                            <input required type="text" class="form-control" id="apellidos"
                                                                                                   name="apellidos" value="<?= $Datames->getOctubre(); ?>"
                                                                                                   placeholder="Ingrese sus apellidos">
                                                                                        </div>

                                                                                        <div class="col-sm-10">
                                                                                            <div class="form-group row">
                                                                                                <label for="noviembre" class="col-sm-2 col-form-label">Nombres</label>
                                                                                                <div class="col-sm-10">
                                                                                                    <input required type="text" class="form-control" id="noviembre"
                                                                                                           name="noviembre" value="<?= $Datames->getNoviembre(); ?>"
                                                                                                           placeholder="Mes">
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="form-group row">
                                                                                                <label for="diciembre" class="col-sm-2 col-form-label">Diciembre</label>
                                                                                                <div class="col-sm-10">
                                                                                                    <input required type="text" class="form-control" id="diciembre"
                                                                                                           name="diciembre" value="<?= $Datames->getDiciembre(); ?>"
                                                                                                           placeholder="Mes">
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
