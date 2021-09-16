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

class inventario extends AbstractDBConnection implements Model
{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private int $Dia_id;
    private int $Dia_ingresos_idingresos;
    private int $Mes_id;
    private Carbon $created_at;
    private Carbon $updated_at;

    /**
     * @param int|null $id
     * @param int $Dia_id
     * @param int $Dia_ingresos_idingresos
     * @param int $Mes_id
     * @param Carbon $created_at
     * @param Carbon $updated_at
     */
    public function __construct(?int $id, int $Dia_id, int $Dia_ingresos_idingresos, int $Mes_id, Carbon $created_at, Carbon $updated_at)
    {
        $this->setId($inventario['id']?? NULL);
        $this->setDiaId($inventario['Dia_id']?? '');
        $this->setDiaIngresosIdingresos($iventario['Dia_ingresos_idingresos']?? '');
        $this->setMesId($inventario['Mes_id'] ?? '');
        $this->setCreatedAt(!empty($ingresos['created_at']) ? Carbon::parse($ingresos['created_at']) : new Carbon());
        $this->setUpdatedAt(!empty($inventario['updated_at']) ? Carbon::parse($inventario['updated_at']) : new Carbon());

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
     * @return int
     */
    public function getMesId(): int
    {
        return $this->Mes_id;
    }

    /**
     * @param int $Mes_id
     */
    public function setMesId(int $Mes_id): void
    {
        $this->Mes_id = $Mes_id;
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