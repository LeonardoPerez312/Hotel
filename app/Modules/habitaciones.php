<?php
namespace App\Models;

use App\Interfaces\Model;
use Carbon\Carbon;
use Exception;
use JetBrains\PhpStorm\Pure;
use JsonSerializable;

require_once ("AbstractDBConnection.php");
require_once (__DIR__."\..\Interfaces\Model.php");
require_once (__DIR__.'/../../vendor/autoload.php');

class habitacion extends AbstractDBConnection implements Model
{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private int $numero_habitacion;
    private int $cantidad_personas;
    private int $precio;
    private int $inventario_idproducto;
    private int $ingresos_idingresos;
    private int $Dia_idDia;
    private int $Dia_ingresos_idingresos;
    private Carbon $updated_at;

    /**
     * @param int|null $id
     * @param int $numero_habitacion
     * @param int $cantidad_personas
     * @param int $precio
     * @param int $inventario_idproducto
     * @param int $ingresos_idingresos
     * @param int $Dia_idDia
     * @param int $Dia_ingresos_idingresos
     * @param Carbon $updated_at
     */
    public function __construct (array $empleados = [])
    {
        $this->setId($habitaciones['id']?? NULL);
        $this->setNumeroHabitacion($habitaciones['numero_habitacion'] ?? 0);
        $this->setCantidadPersonas($habitaciones['cantidad_personas'] ?? 0);
        $this->setPrecio($habitaciones['precio'] ?? 0);
        $this->setInventarioIdproducto($habitaciones['inventario_idproducto'] ?? '');
        $this->setIngresosIdingresos($habitaciones['ingresos_idingresos'] ?? '');
        $this->setDiaIdDia($habitaciones['Dia_idDia'] ?? '');
        $this->setDiaIngresosIdingresos($habitaciones['Dia_ingresos_idingresos'] ?? '');
        $this->setCreatedAt(!empty($habitaciones['created_at']) ? Carbon::parse($habitaciones['created_at']) : new Carbon());
        $this->setUpdatedAt(!empty($habitaciones['updated_at']) ? Carbon::parse($habitaciones['updated_at']) : new Carbon());

    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getNumeroHabitacion(): int
    {
        return $this->numero_habitacion;
    }

    /**
     * @param int $numero_habitacion
     */
    public function setNumeroHabitacion(int $numero_habitacion): void
    {
        $this->numero_habitacion = $numero_habitacion;
    }

    /**
     * @return int
     */
    public function getCantidadPersonas(): int
    {
        return $this->cantidad_personas;
    }

    /**
     * @param int $cantidad_personas
     */
    public function setCantidadPersonas(int $cantidad_personas): void
    {
        $this->cantidad_personas = $cantidad_personas;
    }

    /**
     * @return int
     */
    public function getPrecio(): int
    {
        return $this->precio;
    }

    /**
     * @param int $precio
     */
    public function setPrecio(int $precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return int
     */
    public function getInventarioIdproducto(): int
    {
        return $this->inventario_idproducto;
    }

    /**
     * @param int $inventario_idproducto
     */
    public function setInventarioIdproducto(int $inventario_idproducto): void
    {
        $this->inventario_idproducto = $inventario_idproducto;
    }

    /**
     * @return int
     */
    public function getIngresosIdingresos(): int
    {
        return $this->ingresos_idingresos;
    }

    /**
     * @param int $ingresos_idingresos
     */
    public function setIngresosIdingresos(int $ingresos_idingresos): void
    {
        $this->ingresos_idingresos = $ingresos_idingresos;
    }

    /**
     * @return int
     */
    public function getDiaIdDia(): int
    {
        return $this->Dia_idDia;
    }

    /**
     * @param int $Dia_idDia
     */
    public function setDiaIdDia(int $Dia_idDia): void
    {
        $this->Dia_idDia = $Dia_idDia;
    }

    /**
     * @return int
     */
    public function getDiaIngresosIdingresos(): int
    {
        return $this->Dia_ingresos_idingresos;
    }

    /**
     * @param int $Dia_ingresos_idingresos
     */
    public function setDiaIngresosIdingresos(int $Dia_ingresos_idingresos): void
    {
        $this->Dia_ingresos_idingresos = $Dia_ingresos_idingresos;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    /**
     * @param Carbon $updated_at
     */
    public function setUpdatedAt(Carbon $updated_at): void
    {
        $this->updated_at = $updated_at;
    }



}

