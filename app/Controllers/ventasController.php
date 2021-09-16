<?php

namespace App\Controllers;

require (__DIR__.'/../../vendor/autoload.php');
use App\Models\GeneralFunctions;
use App\Models\Productos;
use App\Models\Usuarios;
use Carbon\Carbon;


class ventasController
{
 private array $dataventas;

    public function __construct(array $_FORM)
{
    $this->dataventas = array();
    $this->dataventas['id'] = $_FORM['id'] ?? NULL;
    $this->dataventas['nombres'] = $_FORM['nombres'] ?? NULL;
    $this->dataventas['precio'] = $_FORM['apellidos'] ?? null;
    $this->dataventas['fecha'] = !empty($_FORM['fecha']) ? Carbon::parse($_FORM['fecha']) : new Carbon();
    $this->dataventas['Dia_id'] = $_FORM['Dia_id'] ?? 0;
    $this->dataventas['Dia_ingresos_idingresos'] = $_FORM['Dia_ingresos_idingresos'] ?? 0;

}
    public function create() {
        try {
            if (!empty($this->dataventas['nombre']) && !ventas::productoRegistrado($this->dataventas['nombre'])) {
                $ventas = new ventas ($this->dataventas);
                if ($ventas->insert()) {
                    unset($_SESSION['frmventas']);
                    header("Location: ../../views/modules/ventas/index.php?respuesta=success&mensaje=Producto Registrado!");
                }
            } else {
                header("Location: ../../views/modules/ventas/create.php?respuesta=error&mensaje=Producto ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function edit()
    {
        try {
            $ventas = new ventas($this->dataventas);
            if($ventas->update()){
                unset($_SESSION['frmventas']);
            }

            header("Location: ../../views/modules/ventas/show.php?id=" . $ventas->getId() . "&respuesta=success&mensaje=Producto Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID (array $data){
        try {
            $result = verntas::searchForId($data['id']);
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
            $result = ventas::getAll();
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
            $Objventas = ventas::searchForId($id);
            $Objventas->setEstado("Activo");
            if($Objventas->update()){
                header("Location: ../../views/modules/ventas/index.php");
            }else{
                header("Location: ../../views/modules/ventas/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function inactivate (int $id){
        try {
            $Objventas = ventas::searchForId($id);
            $Objventas->setEstado("Inactivo");
            if($Objventas->update()){
                header("Location: ../../views/modules/ventas/index.php");
            }else{
                header("Location: ../../views/modules/ventas/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectclientes (array $params = []){

        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "ventas_id";
        $params['name'] = $params['name'] ?? "ventas_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrventas = array();
        if($params['where'] != ""){
            $base = "SELECT * FROM ventas WHERE ";
            $arrventas = ventas::search($base.$params['where']);
        }else{
            $arrventas = ventas::getAll();
        }

        $htmlSelect = "<select ".(($params['isMultiple']) ? "multiple" : "")." ".(($params['isRequired']) ? "required" : "")." id= '".$params['id']."' name='".$params['name']."' class='".$params['class']."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(is_array($arrventas) && count($arrventas) > 0){
            /* @var $arrventas ventas[] */
            foreach ($arrventas as $ventas)
                if (!ventasController::ventasIsInArray($ventas->getId(),$params['arrExcluir']))
                    $htmlSelect .= "<option ".(($ventas != "") ? (($params['defaultValue'] == $ventas->getId()) ? "selected" : "" ) : "")." value='".$ventas->getId()."'>".$ventas->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    public static function ventasIsInArray($idventas, $Arrventas){
        if(count($Arrventas) > 0){
            foreach ($Arrventas as $ventas){
                if($ventas->getId() == $idventas){
                    return true;
                }
            }
        }
        return false;
    }


}
