<?php

namespace App\Controllers;

require (__DIR__.'/../../vendor/autoload.php');
use App\Models\GeneralFunctions;
use App\Models\Productos;
use App\Models\Usuarios;
use Carbon\Carbon;


class habitacionesController
{
 private array $datahabitaciones;

    public function __construct(array $_FORM)
{
    $this->datahabitaciones = array();
    $this->datahabitaciones['id'] = $_FORM['id'] ?? NULL;
    $this->datahabitaciones['numero_habitacion'] = $_FORM['numero_habitacion'] ?? NULL;
    $this->datahabitaciones['cantidad_personas'] = $_FORM['cantidad_personas'] ?? null;
    $this->datahabitaciones['precio'] = $_FORM['precio'] ?? NULL;
    $this->datahabitaciones['inventario_idproducto'] = $_FORM['inventario_idproducto'] ?? '';
    $this->datahabitaciones['ingresos_idingresos'] = $_FORM['ingresos_idingresos'] ?? '';
    $this->datahabitaciones['Dia_idDia'] = $_FORM['Dia_idDia'] ?? '';
    $this->datahabitaciones['Dia_ingresos_idingresos'] = $_FORM['Dia_ingresos_idingresos'] ?? '';

}

    public function create() {
        try {
            if (!empty($this->datahabitaciones['nombre']) && !habitaciones::productoRegistrado($this->dataHabitaciones['nombre'])) {
                $clientes = new clientes ($this->datahabitaciones);
                if ($clientes->insert()) {
                    unset($_SESSION['frmProductos']);
                    header("Location: ../../views/modules/habitaciones/index.php?respuesta=success&mensaje=Producto Registrado!");
                }
            } else {
                header("Location: ../../views/modules/habitaciones/create.php?respuesta=error&mensaje=Producto ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function edit()
    {
        try {
            $habitaciones = new habitaciones($this->datahabitaciones);
            if($habitaciones->update()){
                unset($_SESSION['frmhabitaciones']);
            }

            header("Location: ../../views/modules/habitaciones/show.php?id=" . $habitaciones->getId() . "&respuesta=success&mensaje=Producto Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID (array $data){
        try {
            $result = habitaciones::searchForId($data['id']);
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
            $result = habitaciones::getAll();
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
            $Objclientes = habitaciones::searchForId($id);
            $Objclientes->setEstado("Activo");
            if($Objclientes->update()){
                header("Location: ../../views/modules/habitaciones/index.php");
            }else{
                header("Location: ../../views/modules/habitaciones/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function inactivate (int $id){
        try {
            $Objhabitaciones = habitaciones::searchForId($id);
            $Objhabitaciones->setEstado("Inactivo");
            if($Objhabitaciones->update()){
                header("Location: ../../views/modules/habitaciones/index.php");
            }else{
                header("Location: ../../views/modules/habitacines/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectclientes (array $params = []){

        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "habitaciones_id";
        $params['name'] = $params['name'] ?? "habitaciones_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrhabitaciones = array();
        if($params['where'] != ""){
            $base = "SELECT * FROM habitaciones WHERE ";
            $arrhabitaciones = habitaciones::search($base.$params['where']);
        }else{
            $arrhabitaciones = habitaciones::getAll();
        }

        $htmlSelect = "<select ".(($params['isMultiple']) ? "multiple" : "")." ".(($params['isRequired']) ? "required" : "")." id= '".$params['id']."' name='".$params['name']."' class='".$params['class']."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(is_array($arrhabitaciones) && count($arrhabitaciones) > 0){
            /* @var $arrhabitaciones habitaciones[] */
            foreach ($arrhabitaciones as $habitaciones)
                if (!habitacionesController::habitacionesIsInArray($habitaciones->getId(),$params['arrExcluir']))
                    $htmlSelect .= "<option ".(($habitaciones != "") ? (($params['defaultValue'] == $habitaciones->getId()) ? "selected" : "" ) : "")." value='".$habitaciones->getId()."'>".$habitaciones->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    public static function habitacionesIsInArray($idhabitaciones, $Arrhabitaciones){
        if(count($Arrhabitaciones) > 0){
            foreach ($Arrhabitaciones as $habitaciones){
                if($habitaciones->getId() == $idhabitaciones){
                    return true;
                }
            }
        }
        return false;
    }

}