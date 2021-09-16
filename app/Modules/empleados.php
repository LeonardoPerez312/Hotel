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

class empleados extends AbstractDBConnection implements Model
{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private string $nombres;
    private string $apellidos;
    private string $cargo;
    private string $tipo_documento;
    private int $documento;
    private int $celular;
    private string $turno;
    private int $salario;
    private int $gastos_idgastos;
    private Carbon $created_at;
    private Carbon $updated_at;

    /**
     * @param int|null $id
     * @param string $nombres
     * @param string $apellidos
     * @param string $cargo
     * @param string $tipo_documento
     * @param int $documento
     * @param int $celular
     * @param string $turno
     * @param int $salario
     * @param int $gastos_idgastos
     * @param Carbon $created_at
     * @param Carbon $updated_at
     */
    public function __construct (array $empleados = [])
    {
        $this->setId($empleados['id'] ?? null);
        $this->setNombres($empleados['nombre'] ?? '');
        $this->setApellidos($empleados ['apellidos']?? '');
        $this->setCargo($empleados ['ncargo'] ?? '');
        $this->setTipoDocumento($empleados ['tipo_documento']?? 0);
        $this->setDocumento($empleados ['documento'] ?? 0);
        $this->setCelular($empleados ['celular'] ?? 0);
        $this->setTurno($empleados ['turno'] ?? '');
        $this->setSalario($empleados ['salario'] ?? 0);
        $this->setGastosIdgastos($empleados ['gastos_idgastos'] ?? '');

        $this->setCreatedAt(!empty($epleados['created_at']) ? Carbon::parse($empleados['created_at']) : new Carbon());
        $this->setUpdatedAt(!empty($empleados['updated_at']) ? Carbon::parse($empleados['updated_at']) : new Carbon());

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
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     */
    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return string
     */
    public function getCargo(): string
    {
        return $this->cargo;
    }

    /**
     * @param string $cargo
     */
    public function setCargo(string $cargo): void
    {
        $this->cargo = $cargo;
    }

    /**
     * @return string
     */
    public function getTipoDocumento(): string
    {
        return $this->tipo_documento;
    }

    /**
     * @param string $tipo_documento
     */
    public function setTipoDocumento(string $tipo_documento): void
    {
        $this->tipo_documento = $tipo_documento;
    }

    /**
     * @return int
     */
    public function getDocumento(): int
    {
        return $this->documento;
    }

    /**
     * @param int $documento
     */
    public function setDocumento(int $documento): void
    {
        $this->documento = $documento;
    }

    /**
     * @return int
     */
    public function getCelular(): int
    {
        return $this->celular;
    }

    /**
     * @param int $celular
     */
    public function setCelular(int $celular): void
    {
        $this->celular = $celular;
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
     * @return int
     */
    public function getSalario(): int
    {
        return $this->salario;
    }

    /**
     * @param int $salario
     */
    public function setSalario(int $salario): void
    {
        $this->salario = $salario;
    }

    /**
     * @return int
     */
    public function getGastosIdgastos(): int
    {
        return $this->gastos_idgastos;
    }

    /**
     * @param int $gastos_idgastos
     */
    public function setGastosIdgastos(int $gastos_idgastos): void
    {
        $this->gastos_idgastos = $gastos_idgastos;
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