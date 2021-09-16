<?php

namespace App\Controllers;

require (__DIR__.'/../../vendor/autoload.php');
use App\Models\GeneralFunctions;
use App\Models\Productos;
use App\Models\Usuarios;
use Carbon\Carbon;


class diaController
{
 private array $datadia;

    public function __construct(array $_FORM)
{
    $this->datadia = array();
    $this->datadia['id'] = $_FORM['id'] ?? NULL;
    $this->datadia['ingreso_dia'] = $_FORM['ingreso_dia'] ?? NULL;
    $this->datadia['fecha'] = !empty($_FORM['fecha']) ? Carbon::parse($_FORM['fecha']) : new Carbon();
    $this->datadia['fecha'] = $_FORM['fecha'] ?? null;
    $this->datadia['turno'] = $_FORM['turno'] ?? NULL;
    $this->datadia['persona'] = $_FORM['persona'] ?? NULL;
    $this->datadia['ingresos_idingresos'] = $_FORM['ingresos_idingresos']?? 0;
    $this->datadia['Mes_idMes'] = $_FORM['Mes_idMes'] ?? '';

}
    public function create() {
        try {
            if (!empty($this->datadia['nombre']) && !dia::diaRegistrado($this->datadia['nombre'])) {
                $dia = new dia ($this->datadia);
                if ($dia->insert()) {
                    unset($_SESSION['frmdia']);
                    header("Location: ../../views/modules/dia/index.php?respuesta=success&mensaje=Producto Registrado!");
                }
            } else {
                header("Location: ../../views/modules/dia/create.php?respuesta=error&mensaje=Producto ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function edit()
    {
        try {
            $dia = new dia($this->datadia);
            if($dia->update()){
                unset($_SESSION['frmdia']);
            }

            header("Location: ../../views/modules/dia/show.php?id=" . $dia->getId() . "&respuesta=success&mensaje=Producto Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID (array $data){
        try {
            $result = dia::searchForId($data['id']);
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
            $result = dia::getAll();
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
            $Objdia = dia::searchForId($id);
            $Objdia->setEstado("Activo");
            if($Objdia->update()){
                header("Location: ../../views/modules/dia/index.php");
            }else{
                header("Location: ../../views/modules/dia/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function inactivate (int $id){
        try {
            $Objdia = dia::searchForId($id);
            $Objdia->setEstado("Inactivo");
            if($Objdia->update()){
                header("Location: ../../views/modules/dia/index.php");
            }else{
                header("Location: ../../views/modules/dia/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectclientes (array $params = []){

        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "dia_id";
        $params['Ingreso_dia'] = $params['Ingreso_dia'] ?? "Ingreso_dia_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrdia = array();
        if($params['where'] != ""){
            $base = "SELECT * FROM dia WHERE ";
            $arrdia = dia::search($base.$params['where']);
        }else{
            $arrdia = dia::getAll();
        }

        $htmlSelect = "<select ".(($params['isMultiple']) ? "multiple" : "")." ".(($params['isRequired']) ? "required" : "")." id= '".$params['id']."' name='".$params['name']."' class='".$params['class']."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(is_array($arrdia) && count($arrdia) > 0){
            /* @var $arrdia dia[] */
            foreach ($arrdia as $dia)
                if (!diaController::diaIsInArray($dia->getId(),$params['arrExcluir']))
                    $htmlSelect .= "<option ".(($dia != "") ? (($params['defaultValue'] == $dia->getId()) ? "selected" : "" ) : "")." value='".$dia->getId()."'>".$dia->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    public static function diaIsInArray($iddia, $Arrdia){
        if(count($Arrdia) > 0){
            foreach ($Arrdia as $dia){
                if($dia->getId() == $iddia){
                    return true;
                }
            }
        }
        return false;
    }


}
