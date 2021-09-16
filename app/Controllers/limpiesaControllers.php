<?php

namespace App\Controllers;
require (__DIR__.'/../../vendor/autoload.php');

use App\Models\GeneralFunctions;
use App\Models\Productos;
use Carbon\Carbon;


class limpiesaControllers
{
    private array $datalimpiesa;

    public function __construct(array $_FORM)
    {
        $this->datalimpiesa = array();
        $this->datalimpiesa['id'] = $_FORM['id'] ?? NULL;
        $this->datalimpiesa['numero_habitacion'] = $_FORM['numero_habitacion'] ?? NULL;
        $this->datagastos['fecha'] = !empty($_FORM['fecha']) ? Carbon::parse($_FORM['fecha']) : new Carbon();
        $this->datalimpiesa['empleados_id'] = $_FORM['empleados_id']   ?? '';


    }
    public function create() {
        try {
            if (!empty($this->datalimpiesa['nombre']) && !limpiesa::limpiesaRegistrado($this->datalimpiesa['nombre'])) {
                $limpiesa = new limpiesa ($this->datalimpiesa);
                if ($limpiesa->insert()) {
                    unset($_SESSION['frmlimpiesa']);
                    header("Location: ../../views/modules/limpiesa/index.php?respuesta=success&mensaje=Producto Registrado!");
                }
            } else {
                header("Location: ../../views/modules/limpiesa/create.php?respuesta=error&mensaje=Producto ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function edit()
    {
        try {
            $limpiesa = new limpiesa($this->datalimpiesa);
            if($limpiesa->update()){
                unset($_SESSION['frmlimpiesa']);
            }

            header("Location: ../../views/modules/limpiesa/show.php?id=" . $limpiesa->getId() . "&respuesta=success&mensaje=Producto Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID (array $data){
        try {
            $result = limpiesa::searchForId($data['id']);
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
            $result = limpiesa::getAll();
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
            $Objlimpiesa = limpiesa::searchForId($id);
            $Objlimpiesa->setEstado("Activo");
            if($Objlimpiesa->update()){
                header("Location: ../../views/modules/limpiesa/index.php");
            }else{
                header("Location: ../../views/modules/limpiesa/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function inactivate (int $id){
        try {
            $Objlimpiesa = productos::searchForId($id);
            $Objlimpiesa->setEstado("Inactivo");
            if($Objlimpiesa->update()){
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
        $params['id'] = $params['id'] ?? "limpiesa_id";
        $params['name'] = $params['name'] ?? "habitacion_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrlimpiesa = array();
        if($params['where'] != ""){
            $base = "SELECT * FROM limpiesa WHERE ";
            $arrlimpiesa = limpiesa::search($base.$params['where']);
        }else{
            $arrlimpiesa = limpiesa::getAll();
        }

        $htmlSelect = "<select ".(($params['isMultiple']) ? "multiple" : "")." ".(($params['isRequired']) ? "required" : "")." id= '".$params['id']."' name='".$params['name']."' class='".$params['class']."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(is_array($arrlimpiesa) && count($arrlimpiesa) > 0){
            /* @var $arrlimpiesa limpiesa[] */
            foreach ($arrlimpiesa as $limpiesa)
                if (!limpiesaControllers::limpiesaIsInArray($limpiesa->getId(),$params['arrExcluir']))
                    $htmlSelect .= "<option ".(($limpiesa != "") ? (($params['defaultValue'] == $limpiesa->getId()) ? "selected" : "" ) : "")." value='".$limpiesa->getId()."'>".$limpiesa->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    public static function limpiesaIsInArray($idlimpiesa, $Arrlimpiesa){
        if(count($Arrlimpiesa) > 0){
            foreach ($Arrlimpiesa as $limpiesa){
                if($limpiesa->getId() == $idlimpiesa){
                    return true;
                }
            }
        }
        return false;
    }

}