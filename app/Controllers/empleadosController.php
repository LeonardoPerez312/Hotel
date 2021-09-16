<?php

namespace App\Controllers;

require (__DIR__.'/../../vendor/autoload.php');
use App\Models\GeneralFunctions;
use App\Models\Productos;
use App\Models\Usuarios;
use Carbon\Carbon;


class empleadosController
{
 private array $dataempleados;

    public function __construct(array $_FORM)
{
    $this->dataempleados = array();
    $this->dataempleados['id'] = $_FORM['id'] ?? NULL;
    $this->dataempleados['nombres'] = $_FORM['nombres'] ?? NULL;
    $this->dataempleados['apellidos'] = $_FORM['apellidos'] ?? null;
    $this->dataempleados['cargo'] = $_FORM['cargo'] ?? NULL;
    $this->dataempleados['tipo_documento'] = $_FORM['tipo_documento'] ?? NULL;
    $this->dataempleados['turno'] = $_FORM['turno'] ?? NULL;
    $this->dataempleados['hora'] = $_FORM['hora'] ?? NULL;

}
    public function create() {
        try {
            if (!empty($this->dataempleados['nombre']) && !habitaciones::productoRegistrado($this->dataempleados['nombre'])) {
                $empleados = new empleados ($this->dataempleados);
                if ($empleados->insert()) {
                    unset($_SESSION['frmempleados']);
                    header("Location: ../../views/modules/empleados/index.php?respuesta=success&mensaje=Producto Registrado!");
                }
            } else {
                header("Location: ../../views/modules/empleados/create.php?respuesta=error&mensaje=Producto ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function edit()
    {
        try {
            $empleados = new empleados($this->dataempleados);
            if($empleados->update()){
                unset($_SESSION['frmempleados']);
            }

            header("Location: ../../views/modules/empleados/show.php?id=" . $empleados->getId() . "&respuesta=success&mensaje=Producto Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID (array $data){
        try {
            $result = empleados::searchForId($data['id']);
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
            $result = empleados::getAll();
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
            $Objempleados = empleados::searchForId($id);
            $Objempleados->setEstado("Activo");
            if($Objempleados->update()){
                header("Location: ../../views/modules/empleados/index.php");
            }else{
                header("Location: ../../views/modules/empleados/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function inactivate (int $id){
        try {
            $Objempleados = empleados::searchForId($id);
            $Objempleados->setEstado("Inactivo");
            if($Objempleados->update()){
                header("Location: ../../views/modules/empleados/index.php");
            }else{
                header("Location: ../../views/modules/empleados/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectclientes (array $params = []){

        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "empleados_id";
        $params['name'] = $params['name'] ?? "empleados_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrempleados = array();
        if($params['where'] != ""){
            $base = "SELECT * FROM empleados WHERE ";
            $arrempleados = empleados::search($base.$params['where']);
        }else{
            $arrempleados = empleados::getAll();
        }

        $htmlSelect = "<select ".(($params['isMultiple']) ? "multiple" : "")." ".(($params['isRequired']) ? "required" : "")." id= '".$params['id']."' name='".$params['name']."' class='".$params['class']."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(is_array($arrempleados) && count($arrempleados) > 0){
            /* @var $arrempleados empleados[] */
            foreach ($arrempleados as $empleados)
                if (!empleadosController::habitacionesIsInArray($empleados->getId(),$params['arrExcluir']))
                    $htmlSelect .= "<option ".(($empleados != "") ? (($params['defaultValue'] == $empleados->getId()) ? "selected" : "" ) : "")." value='".$empleados->getId()."'>".$empleados->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    public static function empleadosIsInArray($idempleados, $Arrempleados){
        if(count($Arrempleados) > 0){
            foreach ($Arrempleados as $empleados){
                if($empleados->getId() == $idempleados){
                    return true;
                }
            }
        }
        return false;
    }


}
