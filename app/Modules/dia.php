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

class dia extends AbstractDBConnection implements Model
{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private int $ingreso_dia;
    private carbon $fecha;
    private string $turno;
    private string $persona;
    private int $ingresos_idingresos;
    private int $Mes_idMes;
    private Carbon $created_at;
    private Carbon $updated_at;

    /**
     * @param int|null $id
     * @param int $ingreso_dia
     * @param Carbon $fecha
     * @param string $turno
     * @param string $persona
     * @param int $ingresos_idingresos
     * @param int $Mes_idMes
     * @param Carbon $created_at
     * @param Carbon $updated_at
     */
    public function __construct (array $clientes = [])
    {
        $this->setId($dia['id'] ?? NULL);
        $this->setIngresoDia($dia['ingreso_dia'] ?? 0);
        $this->setFecha(!empty($dia['fecha']) ?
            Carbon::parse($dia['fecha']) : new Carbon());
        $this->setTurno($dia['turno'] ?? '');
        $this->setPersona($dia['persona']?? '');
        $this->setIngresosIdingresos($dia['ingresos_idingresos']?? 0);
        $this->setMesIdMes($dia['Mes_idMes']?? 0);


        $this->setCreatedAt(!empty($dia['created_at']) ? Carbon::parse($dia['created_at']) : new Carbon());
        $this->setUpdatedAt(!empty($dia['updated_at']) ? Carbon::parse($dia['updated_at']) : new Carbon());
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
    public function getIngresoDia(): int
    {
        return $this->ingreso_dia;
    }

    /**
     * @param int $ingreso_dia
     */
    public function setIngresoDia(int $ingreso_dia): void
    {
        $this->ingreso_dia = $ingreso_dia;
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
     * @return string
     */
    public function getTurno(): string
    {
        return $this->turno;
    }

    /**
     * @param string $turno
     */
    public function setTurno(string $turno): void
    {
        $this->turno = $turno;
    }

    /**
     * @return string
     */
    public function getPersona(): string
    {
        return $this->persona;
    }

    /**
     * @param string $persona
     */
    public function setPersona(string $persona): void
    {
        $this->persona = $persona;
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
    public function getMesIdMes(): int
    {
        return $this->Mes_idMes;
    }

    /**
     * @param int $Mes_idMes
     */
    public function setMesIdMes(int $Mes_idMes): void
    {
        $this->Mes_idMes = $Mes_idMes;
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