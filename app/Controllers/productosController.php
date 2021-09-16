<?php

namespace App\Controllers;

require (__DIR__.'/../../vendor/autoload.php');
use App\Models\GeneralFunctions;
use App\Models\Productos;
use App\Models\Usuarios;
use Carbon\Carbon;


class productosController
{
 private array $dataproductos;

    public function __construct(array $_FORM)
{
    $this->dataproductos = array();
    $this->dataproductos['id'] = $_FORM['id'] ?? NULL;
    $this->dataproductos['nombres_producto'] = $_FORM['nombres_producto'] ?? NULL;
    $this->dataproductos['cantidad'] = $_FORM['cantidad'] ?? null;
    $this->dataproductos['precio'] = $_FORM['precio'] ?? NULL;
    $this->dataproductos['inventario_idproducto'] = $_FORM['inventario_idproducto'] ?? 0;
    $this->dataproductos['ventas_idventas'] = $_FORM['ventas_idventas'] ?? 0;


}
    public function create() {
        try {
            if (!empty($this->dataproductos['nombre']) && !productos::productoRegistrado($this->dataproductos['nombre'])) {
                $productos = new productos ($this->dataproductos);
                if ($productos->insert()) {
                    unset($_SESSION['frmProductos']);
                    header("Location: ../../views/modules/productos/index.php?respuesta=success&mensaje=Producto Registrado!");
                }
            } else {
                header("Location: ../../views/modules/productos/create.php?respuesta=error&mensaje=Producto ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function edit()
    {
        try {
            $productos = new productos($this->dataproductos);
            if($productos->update()){
                unset($_SESSION['frmProductos']);
            }

            header("Location: ../../views/modules/productos/show.php?id=" . $productos->getId() . "&respuesta=success&mensaje=Producto Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID (array $data){
        try {
            $result = productos::searchForId($data['id']);
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

    static public function getAll (array $data = null){
        try {
            $result = productos::getAll();
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

    static public function activate (int $id){
        try {
            $Objproductos = productos::searchForId($id);
            $Objproductos->setEstado("Activo");
            if($Objproductos->update()){
                header("Location: ../../views/modules/productos/index.php");
            }else{
                header("Location: ../../views/modules/productos/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function inactivate (int $id){
        try {
            $Objproductos = productos::searchForId($id);
            $Objproductos->setEstado("Inactivo");
            if($Objproductos->update()){
                header("Location: ../../views/modules/productos/index.php");
            }else{
                header("Location: ../../views/modules/productos/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectclientes (array $params = []){

        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "productos_id";
        $params['name'] = $params['name'] ?? "productos_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrproductos = array();
        if($params['where'] != ""){
            $base = "SELECT * FROM productos WHERE ";
            $arrproductos = Productos::search($base.$params['where']);
        }else{
            $arrproductos = Productos::getAll();
        }

        $htmlSelect = "<select ".(($params['isMultiple']) ? "multiple" : "")." ".(($params['isRequired']) ? "required" : "")." id= '".$params['id']."' name='".$params['name']."' class='".$params['class']."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(is_array($arrproductos) && count($arrproductos) > 0){
            /* @var $arrproductos productos[] */
            foreach ($arrproductos as $productos)
                if (!productosController::productosIsInArray($productos->getId(),$params['arrExcluir']))
                    $htmlSelect .= "<option ".(($productos != "") ? (($params['defaultValue'] == $productos->getId()) ? "selected" : "" ) : "")." value='".$productos->getId()."'>".$productos->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    public static function productosIsInArray($idproductos, $Arrproductos){
        if(count($Arrproductos) > 0){
            foreach ($Arrproductos as $productos){
                if($productos->getId() == $idproductos){
                    return true;
                }
            }
        }
        return false;
    }


}
