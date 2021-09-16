<?php

namespace App\Controllers;

require (__DIR__.'/../../vendor/autoload.php');
use App\Models\GeneralFunctions;
use App\Models\Productos;
use App\Models\Usuarios;
use Carbon\Carbon;


class clientesController
{
 private array $dataclientes;

    public function __construct(array $_FORM)
{
    $this->dataclientes = array();
    $this->dataclientes['id'] = $_FORM['id'] ?? NULL;
    $this->dataclientes['nombres'] = $_FORM['nombres'] ?? NULL;
    $this->dataclientes['apellidos'] = $_FORM['apellidos'] ?? null;
    $this->dataclientes['tipo_documento'] = $_FORM['tipo_documento'] ?? NULL;
    $this->dataclientes['numero_documento'] = $_FORM['numero_documento'] ?? NULL;
    $this->dataclientes['celular'] = $_FORM['celular'] ?? NULL;
    $this->dataclientes['ciudad'] = $_FORM['ciudad'] ?? NULL;
    $this->dataclientes['direccion'] = $_FORM['direccion'] ?? NULL;
    $this->dataclientes['fecha'] = !empty($_FORM['fecha']) ? Carbon::parse($_FORM['fecha']) : new Carbon();
    $this->dataclientes['hora'] = $_FORM['hora'] ?? NULL;
    $this->dataclientes['gastos_lavanderia'] = $_FORM['gastos_lavanderia'] ?? NULL;
    $this->dataclientes['habitaciones_idhabitaciones'] = $_FORM['habitaciones_idhabitaciones'] ?? '';

}

    public function create() {
        try {
            if (!empty($this->dataClientes['nombre']) && !clientes::productoRegistrado($this->dataClientes['nombre'])) {
                $clientes = new clientes ($this->dataClientes);
                if ($clientes->insert()) {
                    unset($_SESSION['frmProductos']);
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
            $clientes = new clientes($this->dataClientes);
            if($clientes->update()){
                unset($_SESSION['frmclientes']);
            }

            header("Location: ../../views/modules/dia/show.php?id=" . $clientes->getId() . "&respuesta=success&mensaje=Producto Actualizado");
        } catch (\Exception $e) {
            GeneralFunctions::logFile('Exception',$e, 'error');
        }
    }

    static public function searchForID (array $data){
        try {
            $result = clientes::searchForId($data['id']);
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
            $result = clientes::getAll();
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
            $Objclientes = clientes::searchForId($id);
            $Objclientes->setEstado("Activo");
            if($Objclientes->update()){
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
            $Objclientes = clientes::searchForId($id);
            $Objclientes->setEstado("Inactivo");
            if($Objclientes->update()){
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
        $params['id'] = $params['id'] ?? "clientes_id";
        $params['name'] = $params['name'] ?? "clientes_id";
        $params['defaultValue'] = $params['defaultValue'] ?? "";
        $params['class'] = $params['class'] ?? "form-control";
        $params['where'] = $params['where'] ?? "";
        $params['arrExcluir'] = $params['arrExcluir'] ?? array();
        $params['request'] = $params['request'] ?? 'html';

        $arrclientes = array();
        if($params['where'] != ""){
            $base = "SELECT * FROM dia WHERE ";
            $arrclientes = clientes::search($base.$params['where']);
        }else{
            $arrclientes = clientes::getAll();
        }

        $htmlSelect = "<select ".(($params['isMultiple']) ? "multiple" : "")." ".(($params['isRequired']) ? "required" : "")." id= '".$params['id']."' name='".$params['name']."' class='".$params['class']."'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(is_array($arrclientes) && count($arrclientes) > 0){
            /* @var $arrclientes clientes[] */
            foreach ($arrclientes as $clientes)
                if (!clientesController::clientesIsInArray($clientes->getId(),$params['arrExcluir']))
                    $htmlSelect .= "<option ".(($clientes != "") ? (($params['defaultValue'] == $clientes->getId()) ? "selected" : "" ) : "")." value='".$clientes->getId()."'>".$clientes->getNombre()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    public static function clientesIsInArray($idclientes, $Arrclientes){
        if(count($Arrclientes) > 0){
            foreach ($Arrclientes as $clientes){
                if($clientes->getId() == $idclientes){
                    return true;
                }
            }
        }
        return false;
    }

}