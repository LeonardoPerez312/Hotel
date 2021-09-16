<?php

namespace App\Controllers;

require (__DIR__.'/../../vendor/autoload.php');
use App\Models\GeneralFunctions;
use App\Models\Productos;
use App\Models\Usuarios;
use Carbon\Carbon;


class mesController
{
 private array $datames;

    public function __construct(array $_FORM)
{
    $this->dataclientes = array();
    $this->dataclientes['id'] = $_FORM['id'] ?? NULL;
    $this->dataclientes['enero'] = $_FORM['enero'] ?? NULL;
    $this->dataclientes['febrero'] = $_FORM['febrero'] ?? null;
    $this->dataclientes['marzo'] = $_FORM['marzo'] ?? NULL;
    $this->dataclientes['abril'] = $_FORM['abril'] ?? NULL;
    $this->dataclientes['mayo'] = $_FORM['mayo'] ?? NULL;
    $this->dataclientes['junio'] = $_FORM['junio'] ?? NULL;
    $this->dataclientes['julio'] = $_FORM['julio'] ?? null;
    $this->dataclientes['agosto'] = $_FORM['agosto'] ?? NULL;
    $this->dataclientes['septiembre'] = $_FORM['septiembre'] ?? NULL;
    $this->dataclientes['octubre'] = $_FORM['octubre'] ?? NULL;
    $this->dataclientes['nobiembre'] = $_FORM['nobiembre'] ?? NULL;
    $this->dataclientes['diciembre'] = $_FORM['diciembre'] ?? NULL;

}
    public function create() {
        try {
            if (!empty($this->datames['nombre']) && !mes::mesRegistrado($this->datames['nombre'])) {
                $mes = new mes ($this->datames);
                if ($mes->insert()) {
                    unset($_SESSION['frmProductos']);
                    header("Location: ../../views/modules/mes/index.php?respuesta=success&mensaje=Producto Registrado!");
                }
            } else {
                header("Location: ../../views/modules/mes/create.php?respuesta=error&mensaje=Producto ya registrado");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    public function edit()
    {
        try {
            $mes = new mes ($this->datames);
            if($mes->update()){
                unset($_SESSION['frmmes']);
            }

            header("Location: ../../views/modules/habitaciones/show.php?id=" . $mes->getId() . "&respuesta=success&mensaje=Producto Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID (array $data){
        try {
            $result = mes::searchForId($data['id']);
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
            $result = mes::getAll();
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
            $Objmes = mes::searchForId($id);
            $Objmes->setEstado("Activo");
            if($Objmes->update()){
                header("Location: ../../views/modules/mes/index.php");
            }else{
                header("Location: ../../views/modules/mes/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function inactivate (int $id){
        try {
            $Objmes = mes::searchForId($id);
            $Objmes->setEstado("Inactivo");
            if($Objmes->update()){
                header("Location: ../../views/modules/mes/index.php");
            }else{
                header("Location: ../../views/modules/mes/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function selectclientes (array $params = []){

        $params['isMultiple'] = $params['isMultiple'] ?? false;
        $params['isRequired'] = $params['isRequired'] ?? true;
        $params['id'] = $params['id'] ?? "mes_id";
        $params['name'] = $params['name'] ?? "mes_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrmes = array();
        if($params['where'] != ""){
            $base = "SELECT * FROM mes WHERE ";
            $arrmes = mes::search($base.$params['where']);
        }else{
            $arrmes = mes::getAll();
        }

        $htmlSelect = "<select ".(($params['isMultiple']) ? "multiple" : "")." ".(($params['isRequired']) ? "required" : "")." id= '".$params['id']."' name='".$params['name']."' class='".$params['class']."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(is_array($arrmes) && count($arrmes) > 0){
            /* @var $arrmes mes[] */
            foreach ($arrmes as $mes)
                if (!mesController::mesIsInArray($mes->getId(),$params['arrExcluir']))
                    $htmlSelect .= "<option ".(($mes != "") ? (($params['defaultValue'] == $mes->getId()) ? "selected" : "" ) : "")." value='".$mes->getId()."'>".$mes->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    public static function mesIsInArray($idmes, $Arrmes){
        if(count($Arrmes) > 0){
            foreach ($Arrmes as $mes){
                if($mes->getId() == $idmes){
                    return true;
                }
            }
        }
        return false;
    }


}
