<?php
require("../../partials/routes.php");
require_once("../../partials/check_login.php");

use App\Controllers\ProductosController;
use App\Controllers\UsuariosController;
use App\Controllers\VentasController;
use App\Models\DetalleVentas;
use App\Models\GeneralFunctions;
use Carbon\Carbon;

$nameModel = "Venta";
$nameForm = 'frmCreate'.$nameModel;
$pluralModel = $nameModel.'s';
$frmSession = $_SESSION[$nameForm] ?? NULL;
?>

<?php
$dataVenta = null;
if (!empty($_GET['id'])) {
    $dataVenta = VentasController::searchForID(["id" => $_GET['id']]);
    if ($dataVenta->getEstado() != "En progreso"){
        header('Location: index.php?respuesta=warning&mensaje=La venta ya ha finalizado');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $_ENV['TITLE_SITE'] ?> | Crear <?= $nameModel ?></title>
    <?php require("../../partials/head_imports.php"); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= $adminlteURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <?php require("../../partials/navbar_customization.php"); ?>

    <?php require("../../partials/sliderbar_main_menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Generar Mensaje de alerta -->
        <?= (!empty($_GET['respuesta'])) ? GeneralFunctions::getAlertDialog($_GET['respuesta'], $_GET['mensaje']) : ""; ?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear una nueva <?= $nameModel ?></h1>
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
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-shopping-cart"></i> &nbsp; Información de la
                                    <?= $nameModel ?></h3>
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

                            <div class="card-body">
                                <form class="form-horizontal" method="post" id="<?= $nameForm ?>" name="<?= $nameForm ?>"
                                      action="../../../app/Controllers/MainController.php?controller=<?= $pluralModel ?>&action=create">
                                    <div class="form-group row">

                                        <div class="col-sm-10">
                                            <div class="form-group row">
                                                <label for="nombre_producto" class="col-sm-2 col-form-label">Nombres Producto</label>
                                                <div class="col-sm-10">
                                                    <input required type="text" class="form-control" id="nombre_producto" name="nombre_producto"
                                                           placeholder="Ingrese sus nombres" value="<?= $frmSession['nombre_producto'] ?? '' ?>">
                                                </div>
                                            </div>

                                    <div class="form-group row">
                                        <label for="numero_serie" class="col-sm-4 col-form-label">Precio
                                            Venta</label>
                                        <div class="col-sm-8">
                                            <?= $dataventas->getNumeroSerie() ?>
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                            <label for="numero_serie" class="col-sm-4 col-form-label">Fecha
                                                Venta</label>
                                            <div class="col-sm-8">
                                                <?= $dataventas->getFechaVenta() ?>
                                            </div>

                                        </div>
                                            <div class="form-group row">
                                                <label for="Dia_id" class="col-sm-2 col-form-label">Ventas</label>
                                                <div class="col-sm-10 ">
                                                    <?= diaController::selectCategoria(
                                                        array(
                                                            'id' => 'Dia_id',
                                                            'name' => 'Dia_id',
                                                            'defaultValue' => (!empty($frmSession['ventas_idventas'])) ? $frmSession['Dia_id'] : '',
                                                            'class' => 'form-control select2bs4 select2-info',
                                                            'where' => "estado = 'Activo'"
                                                        )
                                                    );
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                    <hr>
                                    <button type="submit" class="btn btn-info">Enviar</button>
                                    <a href="index.php" role="button" class="btn btn-default float-right">Cancelar</a>
                                </form>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>


                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->




</body>
</html>
