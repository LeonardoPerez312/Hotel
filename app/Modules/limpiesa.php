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

class limpiesa extends AbstractDBConnection implements Model
{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private int $nuemro_habitacion;
    private carbon $fecha;
    private int $empleados_id;
    private Carbon $updated_at;

    /**
     * @param int|null $id
     * @param int $nuemro_habitacion
     * @param Carbon $fecha
     * @param int $empleados_id
     * @param Carbon $updated_at
     */
    public function __construct(array $limpiesa = [])
    {
        $this->setId($limpiesa['id']?? NULL );
        $this->setNuemroHabitacion($limpiesa['numero_habitacion'] ?? 0);
          $this->setFecha(!empty($limpiesa['fecha']) ?
              Carbon::parse($limpiesa['fecha']) : new Carbon());
          $this->setUpdatedAt(!empty($limpiesa['updated_at']) ?
              Carbon::parse($limpiesa['updated_at']) : new Carbon());

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
    public function getNuemroHabitacion(): int
    {
        return $this->nuemro_habitacion;
    }

    /**
     * @param int $nuemro_habitacion
     */
    public function setNuemroHabitacion(int $nuemro_habitacion): void
    {
        $this->nuemro_habitacion = $nuemro_habitacion;
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
    public function getEmpleadosId(): int
    {
        return $this->empleados_id;
    }

    /**
     * @param int $empleados_id
     */
    public function setEmpleadosId(int $empleados_id): void
    {
        $this->empleados_id = $empleados_id;
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