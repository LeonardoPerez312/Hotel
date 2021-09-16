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
                                                <label for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="nombres" name="nombres"
                                                           placeholder="Ingrese sus nombres" value="<?= $frmSession['nombres'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="apellidos"
                                                           name="apellidos" placeholder="Ingrese sus apellidos"
                                                           value="<?= $frmSession['apellidos'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="cargo" class="col-sm-2 col-form-label">Cargo</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="cargo"
                                                           name="cargo" placeholder="Ingrese sus apellidos"
                                                           value="<?= $frmSession['cargo'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tipo_documento" class="col-sm-2 col-form-label">
                                                    Tipo Documento</label>
                                                <div class="col-sm-10">
                                                    <select id="tipo_documento" name="tipo_documento" class="custom-select">
                                                        <option <?= (!empty($frmSession['tipo_documento']) && $frmSession['tipo_documento'] == "C.C") ? "selected" : ""; ?> value="C.C">Cedula de Ciudadania</option>
                                                        <option <?= (!empty($frmSession['tipo_documento']) && $frmSession['tipo_documento'] == "T.I") ? "selected" : ""; ?> value="T.I">Tarjeta de Identidad</option>
                                                        <option <?= (!empty($frmSession['tipo_documento']) && $frmSession['tipo_documento'] == "Pasaporte") ? "selected" : ""; ?> value="Pasaporte">Pasaporte</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="numero_cedula" class="col-sm-2 col-form-label">Documento</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" minlength="6" class="form-control"
                                                           id="numero_cedula" name="numero_cedula" placeholder="Ingrese su documento"
                                                           value="<?= $frmSession['numero_cedula'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="telefono" class="col-sm-2 col-form-label">Celular</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" minlength="6" class="form-control"
                                                           id="telefono" name="telefono" placeholder="Ingrese su telefono"
                                                           value="<?= $frmSession['celular'] ?? '' ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="direccion"
                                                           name="direccion" placeholder="Ingrese su direccion"
                                                           value="<?= $frmSession['direccion'] ?? '' ?>">
                                                </div>
                                            </div>


                                            <?php if ($_SESSION['UserInSession']['rol'] == 'Administrador'){ ?>



                                                <div class="form-group row">
                                                    <label for="rol" class="col-sm-2 col-form-label">turno</label>
                                                    <div class="col-sm-10">
                                                        <select required id="rol" name="rol" class="custom-select">
                                                            <option <?= (!empty($frmSession['turno']) && $frmSession['rol'] == "Mañana") ? "selected" : ""; ?> value="Administrador">Mañana</option>
                                                            <option <?= (!empty($frmSession['turno']) && $frmSession['rol'] == "tarde") ? "selected" : ""; ?> value="Empleado">Tarde</option>
                                                            <option <?= (!empty($frmSession['turno']) && $frmSession['rol'] == "Noche") ? "selected" : ""; ?> value="Cliente">Noche</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            <div class="form-group row">
                                                <label for="salario" class="col-sm-2 col-form-label">Salario</label>
                                                <div class="col-sm-10">
                                                    <input required type="number" minlength="6" class="form-control"
                                                           id="Salario" name="Salario" placeholder="Ingrese salario,del trabajador"
                                                           value="<?= $frmSession['documento'] ?? '' ?>">
                                                </div>

                                            <?php } ?>
                                        </div>

                                            <div class="form-group row">
                                                <label for="gastos_idgastos" class="col-sm-2 col-form-label">gastos</label>
                                                <div class="col-sm-10 ">
                                                    <?= empleadosController::selectCategoria(
                                                        array(
                                                            'id' => 'gastos_idgastos',
                                                            'name' => 'gastos_idgastos',
                                                            'defaultValue' => (!empty($frmSession['gastos_idgastos'])) ? $frmSession['gastos_idgastos'] : '',
                                                            'class' => 'form-control select2bs4 select2-info',
                                                            'where' => "estado = 'Activo'"
                                                        )
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="habitaciones_id" class="col-sm-2 col-form-label">habitaciones</label>
                                                <div class="col-sm-10 ">
                                                    <?= empleadosController::selectCategoria(
                                                        array(
                                                            'id' => 'habitaciones_id',
                                                            'name' => 'habitaciones_id',
                                                            'defaultValue' => (!empty($frmSession['habitaciones_id'])) ? $frmSession['habitaciones_id'] : '',
                                                            'class' => 'form-control select2bs4 select2-info',
                                                            'where' => "estado = 'Activo'"
                                                        )
                                                    );
                                                    ?>
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
