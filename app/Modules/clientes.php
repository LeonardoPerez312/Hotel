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

class clientes extends AbstractDBConnection implements Model

{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private string $nombres;
    private string $apellidos;
    private string $tipo_documento;
    private int $documento;
    private int $celular;
    private string $direccion;
    private string $ciudad;
    private Carbon $fecha;
    private carbon $hora;
    private int $gastos_labanderia;
    private int $habitaciones_idhabitaciones;
    private Carbon $created_at;
    private Carbon $updated_at;

    /**
     * @param int|null $id
     * @param string $nombres
     * @param string $apellidos
     * @param string $tipo_documento
     * @param int $documento
     * @param int $celular
     * @param string $direccion
     * @param string $ciudad
     * @param Carbon $fecha
     * @param Carbon $hora
     * @param int $gastos_labanderia
     * @param int $habitaciones_idhabitaciones
     * @param Carbon $created_at
     * @param Carbon $updated_at
     */
    public function __construct(array $clientes = [])
    {
        $this->setId($clientes ['id'] ?? null);
        $this->setNombres($clientes ['nombre'] ?? '');
        $this->setApellidos( ['apellidos']  ?? '');
        $this->setTipoDocumento($clientes ['tipo_documento'] ?? null);
        $this->setDocumento($clientes ['documento'] ?? 0);
        $this->setCelular($clientes ['celular'] ?? 0);
        $this->setDireccion($clientes ['direccion'] ?? '');
        $this->setCiudad($clientes['ciudad'] ?? null);
        $this->setFecha(!empty($clientes['fecha']) ?
            Carbon::parse($clientes['fecha']) : new Carbon());

        $this->setHora(!empty($clientes['hora']) ?
            Carbon::parse($clientes['hora']) : new Carbon());

        $this->setGastosLabanderia($clientes ['getHabitacionesIdhabitaciones']);
        $this->setHabitacionesIdhabitaciones($clientes['habitaciones_idhabitaciones']);

        $this->setCreatedAt(!empty($clientes['created_at']) ? Carbon::parse($clientes['created_at']) : new Carbon());
        $this->setUpdatedAt(!empty($clientes['updated_at']) ? Carbon::parse($clientes['updated_at']) : new Carbon());
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
    public function getDireccion(): string
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion(string $direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return string
     */
    public function getCiudad(): string
    {
        return $this->ciudad;
    }

    /**
     * @param string $ciudad
     */
    public function setCiudad(string $ciudad): void
    {
        $this->ciudad = $ciudad;
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
     * @return Carbon
     */
    public function getHora(): Carbon
    {
        return $this->hora;
    }

    /**
     * @param Carbon $hora
     */
    public function setHora(Carbon $hora): void
    {
        $this->hora = $hora;
    }

    /**
     * @return int
     */
    public function getGastosLabanderia(): int
    {
        return $this->gastos_labanderia;
    }

    /**
     * @param int $gastos_labanderia
     */
    public function setGastosLabanderia(int $gastos_labanderia): void
    {
        $this->gastos_labanderia = $gastos_labanderia;
    }

    /**
     * @return int
     */
    public function getHabitacionesIdhabitaciones(): int
    {
        return $this->habitaciones_idhabitaciones;
    }

    /**
     * @param int $habitaciones_idhabitaciones
     */
    public function setHabitacionesIdhabitaciones(int $habitaciones_idhabitaciones): void
    {
        $this->habitaciones_idhabitaciones = $habitaciones_idhabitaciones;
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
