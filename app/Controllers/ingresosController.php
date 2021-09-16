<?php

namespace App\Controllers;

require (__DIR__.'/../../vendor/autoload.php');
use App\Models\GeneralFunctions;
use App\Models\Productos;
use App\Models\Usuarios;
use Carbon\Carbon;


class ingresosController
{
 private array $dataingresos;

    public function __construct(array $_FORM)
{
    $this->dataingresos = array();
    $this->dataingresos['id'] = $_FORM['id'] ?? NULL;
    $this->dataingresos['valor'] = $_FORM['valor'] ?? NULL;
    $this->dataingresos['fecha'] = !empty($_FORM['fecha']) ? Carbon::parse($_FORM['fecha']) : new Carbon();
    $this->dataingresos['Dia_idDia'] = $_FORM['Dia_idDia']  ?? '';
    $this->dataingresos['Dia_ingresos_idingresos'] = $_FORM['Dia_ingresos_idingresos']  ?? '';


}
    public function create() {
        try {
            if (!empty($this->dataingresos['nombre']) && !ingresos::ingresosRegistrado($this->dataingresos['nombre'])) {
                $ingresos = new ingresos ($this->dataingresos);
                if ($ingresos->insert()) {
                    unset($_SESSION['frmingresos']);
                    header("Location: ../../views/modules/ingresos/index.php?respuesta=success&mensaje=Producto Registrado!");
                }
            } else {
                header("Location: ../../views/modules/ingresos/create.php?respuesta=error&mensaje=Producto ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function edit()
    {
        try {
            $ingresos = new ingresos($this->dataingresos);
            if($ingresos->update()){
                unset($_SESSION['frmingresos']);
            }

            header("Location: ../../views/modules/habitaciones/show.php?id=" . $ingresos->getId() . "&respuesta=success&mensaje=Producto Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID (array $data){
        try {
            $result = ingresos::searchForId($data['id']);
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
            $result = ingresos::getAll();
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
            $Objingresos = ingresos::searchForId($id);
            $Objingresos->setEstado("Activo");
            if($Objingresos->update()){
                header("Location: ../../views/modules/ingresos/index.php");
            }else{
                header("Location: ../../views/modules/ingresos/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function inactivate (int $id){
        try {
            $Objingresos = ingresos::searchForId($id);
            $Objingresos->setEstado("Inactivo");
            if($Objingresos->update()){
                header("Location: ../../views/modules/ingresos/index.php");
            }else{
                header("Location: ../../views/modules/ingresos/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectclientes (array $params = []){

        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "ingresos_id";
        $params['name'] = $params['name'] ?? "habitaciones_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arringresos = array();
        if($params['where'] != ""){
            $base = "SELECT * FROM ingresos WHERE ";
            $arringresos = Productos::search($base.$params['where']);
        }else{
            $arringresos = Productos::getAll();
        }

        $htmlSelect = "<select ".(($params['isMultiple']) ? "multiple" : "")." ".(($params['isRequired']) ? "required" : "")." id= '".$params['id']."' name='".$params['name']."' class='".$params['class']."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(is_array($arringresos) && count($arringresos) > 0){
            /* @var $arringresos ingresos[] */
            foreach ($arringresos as $ingresos)
                if (!ingresosController::ingresossIsInArray($ingresos->getId(),$params['arrExcluir']))
                    $htmlSelect .= "<option ".(($ingresos != "") ? (($params['defaultValue'] == $ingresos->getId()) ? "selected" : "" ) : "")." value='".$ingresos->getId()."'>".$ingresos->getNombre()."</option>";
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
