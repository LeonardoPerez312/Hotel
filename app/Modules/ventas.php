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

class ventas extends AbstractDBConnection implements Model
{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private string $nombres;
    private int $precio;
    private Carbon $fecha;
    private int $Dia_id;
    private int $Dia_ingresos_idingresos;
    private Carbon $created_at;
    private Carbon $updated_at;

    /**
     * @param int|null $id
     * @param string $nombres
     * @param int $precio
     * @param Carbon $fecha
     * @param int $Dia_id
     * @param int $Dia_ingresos_idingresos
     * @param Carbon $created_at
     * @param Carbon $updated_at
     */
    public function __construct(array $ventas = [])
    {
        $this->setId($ventas['id']?? '');
        $this->setNombres($ventas['nombre']?? '');
        $this->setPrecio($ventas['precio']?? '');
        $this->setFecha(!empty($ventas['fecha']) ?
            Carbon::parse($ventas['fecha']) : new Carbon());
        $this->setDiaId($ventas['dia_id'] ?? '');
        $this->setDiaIngresosIdingresos($ventas['Dia_ingresos_idingresos']?? '');
        $this->setCreatedAt(!empty($venta['created_at']) ? Carbon::parse($venta['created_at']) : new Carbon());
        $this->setUpdatedAt(!empty($venta['updated_at']) ? Carbon::parse($venta['updated_at']) : new Carbon());
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
    public function getNombres(): string
    {
        return $this->nombres;
    }

    /**
     * @param string $nombres
     */
    public function setNombres(string $nombres): void
    {
        $this->nombres = $nombres;
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
    public function getDiaId(): int
    {
        return $this->Dia_id;
    }

    /**
     * @param int $Dia_id
     */
    public function setDiaId(int $Dia_id): void
    {
        $this->Dia_id = $Dia_id;
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