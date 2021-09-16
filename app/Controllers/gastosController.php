<?php

namespace App\Controllers;

require (__DIR__.'/../../vendor/autoload.php');
use App\Models\GeneralFunctions;
use App\Models\Productos;
use App\Models\Usuarios;
use Carbon\Carbon;


class gastosController
{
 private array $datagastos;

    public function __construct(array $_FORM)
{
    $this->datagastos = array();
    $this->datagastos['id'] = $_FORM['id'] ?? NULL;
    $this->datagastos['nombres_gasto'] = $_FORM['nombres_gasto'] ?? NULL;
    $this->datagastos['valor'] = $_FORM['valor'] ?? null;
    $this->datagastos['fecha'] = !empty($_FORM['fecha']) ? Carbon::parse($_FORM['fecha']) : new Carbon();
    $this->datagastos['inventario_idproducto'] = $_FORM['inventario_idproducto']  ?? '';


}
    public function create() {
        try {
            if (!empty($this->datagastos['nombre']) && !gastos::gastosRegistrado($this->datagastos['nombre'])) {
                $gastos = new gastos ($this->datagastos);
                if ($gastos->insert()) {
                    unset($_SESSION['frmgastos']);
                    header("Location: ../../views/modules/gastos/index.php?respuesta=success&mensaje=Producto Registrado!");
                }
            } else {
                header("Location: ../../views/modules/gastos/create.php?respuesta=error&mensaje=Producto ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function edit()
    {
        try {
            $gastos = new gastos($this->datagastos);
            if($gastos->update()){
                unset($_SESSION['frmgastos']);
            }

            header("Location: ../../views/modules/gastos/show.php?id=" . $gastos->getId() . "&respuesta=success&mensaje=Producto Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID (array $data){
        try {
            $result = gastos::searchForId($data['id']);
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
            $result = gastos::getAll();
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
            $Objgastos = gastos::searchForId($id);
            $Objgastos->setEstado("Activo");
            if($Objgastos->update()){
                header("Location: ../../views/modules/gastos/index.php");
            }else{
                header("Location: ../../views/modules/gastos/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function inactivate (int $id){
        try {
            $Objgastos = gastos::searchForId($id);
            $Objgastos->setEstado("Inactivo");
            if($Objgastos->update()){
                header("Location: ../../views/modules/gastos/index.php");
            }else{
                header("Location: ../../views/modules/gastos/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectclientes (array $params = []){

        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "gastos_id";
        $params['name'] = $params['name'] ?? "gastos_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrgastos = array();
        if($params['where'] != ""){
            $base = "SELECT * FROM gastos WHERE ";
            $arrgastos = gastos::search($base.$params['where']);
        }else{
            $arrgastos = gastos::getAll();
        }

        $htmlSelect = "<select ".(($params['isMultiple']) ? "multiple" : "")." ".(($params['isRequired']) ? "required" : "")." id= '".$params['id']."' name='".$params['name']."' class='".$params['class']."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(is_array($arrgastos) && count($arrgastos) > 0){
            /* @var $arrgastos gastos[] */
            foreach ($arrgastos as $gastos)
                if (!gastosController::gastosIsInArray($gastos->getId(),$params['arrExcluir']))
                    $htmlSelect .= "<option ".(($gastos != "") ? (($params['defaultValue'] == $gastos->getId()) ? "selected" : "" ) : "")." value='".$gastos->getId()."'>".$gastos->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    public static function gastosIsInArray($idgastos, $Arrgastos){
        if(count($Arrgastos) > 0){
            foreach ($Arrgastos as $gastos){
                if($gastos->getId() == $idgastos){
                    return true;
                }
            }
        }
        return false;
    }


}
