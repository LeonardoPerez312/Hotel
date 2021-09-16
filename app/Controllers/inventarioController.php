<?php

namespace App\Controllers;

require (__DIR__.'/../../vendor/autoload.php');

use App\Models\GeneralFunctions;
use App\Models\Productos;
use Carbon\Carbon;


class inventarioController
{
 private array $datainventario;

    public function __construct(array $_FORM)
{
    $this->datainventario = array();
    $this->datainventario['Dia_idDia'] = $_FORM['Dia_idDia']  ?? '';
    $this->datainventario['Dia_ingresos_idingresos'] = $_FORM['Dia_ingresos_idingresos']  ?? '';


}

    public function create() {
        try {
            if (!empty($this->datainventario['nombre']) && !inventario::inventarioRegistrado($this->datainventario['nombre'])) {
                $inventario = new inventario ($this->datainventario);
                if ($inventario->insert()) {
                    unset($_SESSION['frminventario']);
                    header("Location: ../../views/modules/inventario/index.php?respuesta=success&mensaje=Producto Registrado!");
                }
            } else {
                header("Location: ../../views/modules/inventario/create.php?respuesta=error&mensaje=Producto ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }
    public function edit()
    {
        try {
            $arrinventario = inventarioController::search("SELECT * FROM inventario WHERE * = ".$this->datainventario['*']." and * = ".$this->inventario['*']);
            /* @var $inventario inventario[] */
            $inventario = $arrinventario[0];
            $Oldinventario = $inventario->getinventario();
            $inventario->setinventario($Oldinventario + $this->inventario['*']);
            if ($inventario->update()) {
                $inventario->getProducto()->addStock($this->inventario['*']);
                unset($_SESSION['frminventario']);
                header("Location: ../../views/modules/inventario/create.php?id=".$this->inventario['compra_id']."&respuesta=success&mensaje=Producto Actualizado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function deleted (int $id){
        try {
            $Objinventsario = inventario::searchForId($id);
            $objinventario = $Objinventario->getinventario();
            if($Objinventario->deleted()){
                $objinventario->substractStock($Objinventario->getCantidad());
                header("Location: ../../views/modules/compras/create.php?id=".$Objinventario->getCompraId()."&respuesta=success&mensaje=Producto Eliminado");
            }else{
                header("Location: ../../views/modules/compras/create.php?id=".$Objinventario->getCompraId()."&respuesta=error&mensaje=Error al eliminar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID(array $data)
    {
        try {
            $result = inventario::searchForId($data['id']);
            if (!empty($data['request']) and $data['request'] === 'ajax' and !empty($result)) {
                header('Content-type: application/json; charset=utf-8');
                $result = json_encode($result->jsonSerialize());
            }
            return $result;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
        return null;
    }

    static public function getAll()
    {
        try {
            $result = inventario::getAll();
            if (!empty($data['request']) and $data['request'] === 'ajax') {
                header('Content-type: application/json; charset=utf-8');
                $result = json_encode($result);
            }
            return $result;
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
        return null;
    }
}