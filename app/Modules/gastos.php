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

class gastos extends AbstractDBConnection implements Model
{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private string $nombres_gasto;
    private int $valor;
    private Carbon $fecha;
    private int $inventario_idproducto;
    private Carbon $created_at;
    private Carbon $updated_at;

    /**
     * @param int|null $id
     * @param string $nombres_gasto
     * @param int $valor
     * @param Carbon $fecha
     * @param int $inventario_idproducto
     * @param Carbon $created_at
     * @param Carbon $updated_at
     */
    public function __construct (array $empleados = [])
    {
        $this->setId($gastos['id']?? null);
        $this->setNombresGasto($gastos['nombre']?? '');
        $this->setValor($gastos['valor'] ?? 0);
        $this->setFecha(!empty($gastos['fecha']) ?
            Carbon::parse($gastos['fecha']) : new Carbon());
        $this->setInventarioIdproducto($gastos['inventario_idproducto'] ?? '');
        $this->setCreatedAt(!empty($gastos['created_at']) ? Carbon::parse($gastos['created_at']) : new Carbon());
        $this->setUpdatedAt(!empty($gastos['updated_at']) ? Carbon::parse($gastos['updated_at']) : new Carbon());

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
     * @return string
     */
    public function getNombresGasto(): string
    {
        return $this->nombres_gasto;
    }

    /**
     * @param string $nombres_gasto
     */
    public function setNombresGasto(string $nombres_gasto): void
    {
        $this->nombres_gasto = $nombres_gasto;
    }

    /**
     * @return int
     */
    public function getValor(): int
    {
        return $this->valor;
    }

    /**
     * @param int $valor
     */
    public function setValor(int $valor): void
    {
        $this->valor = $valor;
    }

    /**
     * @return Carbon
     */
    public function getFecha(): Carbon
    {
        return $this->fecha;
    }

    /**
     * @param Carbon $fecha
     */
    public function setFecha(Carbon $fecha): void
    {
        $this->fecha = $fecha;
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
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    /**
     * @param Carbon $created_at
     */
    public function setCreatedAt(Carbon $created_at): void
    {
        $this->created_at = $created_at;
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