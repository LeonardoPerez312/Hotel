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
                                        <div class="form-group row">
                                            <label for="numero_habitacion" class="col-sm-2 col-form-label">Numero Habitacion</label>
                                            <div class="col-sm-10">
                                                <input required type="number" minlength="6" class="form-control"
                                                       id="numero_habitacion" name="numero_habitacion" placeholder="Ingrese el Nnumero de Habitacion"
                                                       value="<?= $frmSession['numero_habitacion'] ?? '' ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group row">
                                                <label for="cantidad_personas" class="col-sm-2 col-form-label">Numero de personas</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" minlength="6" class="form-control"
                                                           id="cantidad_personas" name="cantidad_personas" placeholder="Ingrese el Nnumero de Personas"
                                                           value="<?= $frmSession['cantidad_personas'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" minlength="6" class="form-control"
                                                           id="precio" name="precio" placeholder="Precio"
                                                           value="<?= $frmSession['Precio'] ?? '' ?>">
                                                </div>
                                            </div>





                                            <?php if ($_SESSION['UserInSession']['rol'] == 'Administrador'){ ?>


                                                <div class="form-group row">
                                                    <label for="inventario_idproducto" class="col-sm-2 col-form-label">inventario</label>
                                                    <div class="col-sm-10 ">
                                                        <?= inventarioController::selectCategoria(
                                                            array(
                                                                'id' => 'inventario_idproducto',
                                                                'name' => 'inventario_idproducto',
                                                                'defaultValue' => (!empty($frmSession['inventario_idproducto'])) ? $frmSession['inventario_idproducto'] : '',
                                                                'class' => 'form-control select2bs4 select2-info',
                                                                'where' => "estado = 'Activo'"
                                                            )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="ingresos_idingresos" class="col-sm-2 col-form-label">inventario</label>
                                                    <div class="col-sm-10 ">
                                                        <?= ingresosController::selectCategoria(
                                                            array(
                                                                'id' => 'ingresos_idingresos',
                                                                'name' => 'ingresos_idingresos',
                                                                'defaultValue' => (!empty($frmSession['ingresos_idingresos'])) ? $frmSession['inventario_idproducto'] : '',
                                                                'class' => 'form-control select2bs4 select2-info',
                                                                'where' => "estado = 'Activo'"
                                                            )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="Dia_idDia" class="col-sm-2 col-form-label">Dia</label>
                                                    <div class="col-sm-10 ">
                                                        <?= diaController::selectCategoria(
                                                            array(
                                                                'id' => 'Dia_idDia',
                                                                'name' => 'Dia_idDia',
                                                                'defaultValue' => (!empty($frmSession['Dia_idDia'])) ? $frmSession['Dia_idDia'] : '',
                                                                'class' => 'form-control select2bs4 select2-info',
                                                                'where' => "estado = 'Activo'"
                                                            )
                                                        );
                                                        ?>
                                                    </div>
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
