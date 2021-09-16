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

class ingresos extends AbstractDBConnection implements Model
{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private int $volor;
    private carbon $fecha;
    private int $Dia_idDia;
    private int $Dia_ingresos_idingresos;
    private Carbon $created_at;
    private Carbon $updated_at;

    /**
     * @param int|null $id
     * @param int $volor
     * @param Carbon $fecha
     * @param int $Dia_idDia
     * @param int $Dia_ingresos_idingresos
     * @param Carbon $created_at
     * @param Carbon $updated_at
     */
    public function __construct (array $empleados = [])
    {
        $this->setId($ingresos['id']?? NULL);
        $this->setVolor($ingresos['valor'] ?? 0);
        $this->setFecha(!empty($ingresos['fecha']) ?
            Carbon::parse($ingresos['fecha']) : new Carbon());
        $this->setDiaIdDia($ingresos['Dia_idDia']?? '');
        $this->setDiaIngresosIdingresos($ingresos['Dia_ingresos_idingresos']?? '');
        $this->setCreatedAt(!empty($ingresos['created_at']) ? Carbon::parse($ingresos['created_at']) : new Carbon());
        $this->setUpdatedAt(!empty($ingresos['updated_at']) ? Carbon::parse($ingresos['updated_at']) : new Carbon());
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
    public function getVolor(): int
    {
        return $this->volor;
    }

    /**
     * @param int $volor
     */
    public function setVolor(int $volor): void
    {
        $this->volor = $volor;
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