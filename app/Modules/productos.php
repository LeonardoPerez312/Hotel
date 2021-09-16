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

class productos extends AbstractDBConnection implements Model
{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private string $nombre;
    private string $cantidad;
    private int $precio;
    private int $precio_venta;
    private carbon $fecha;
    private int $inventario_idproducto;
    private int $ventas_idventas;
    private Carbon $created_at;
    private Carbon $updated_at;

    /**
     * @param int $id
     * @param string $nombre
     * @param string $cantidad
     * @param int $precio
     * @param int $precio_venta
     * @param Carbon $fecha
     * @param int $inventario_idproducto
     * @param int $ventas_idventas
     * @param Carbon $created_at
     * @param Carbon $updated_at
     */
    public function __construct(array $productos = [])
    {
        $this->setId($productos['id']  ?? NULL );
        $this->setNombre($productos['nombre'] ?? '');
        $this->setCantidad($productos['cantidad'] ?? 0);
        $this->setPrecio($productos['precio'] ?? 0);
        $this->setPrecioVenta($productos['preci_venta'] ?? 0);
        $this->setFecha(!empty($productos['fecha']) ?
            Carbon::parse($productos['fecha']) : new Carbon());
        $this->setPrecioVenta($productos['inventario_idproducto']?? '');
        $this->setVentasIdventas($productos['ventas_idventas']?? '');
        $this->setCreatedAt(!empty($productos['created_at']) ?
            Carbon::parse($productos['created_at']) : new Carbon());
        $this->setUpdatedAt(!empty($productos['updated_at']) ?
            Carbon::parse($productos['updated_at']) : new Carbon());

}
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getCantidad(): string
    {
        return $this->cantidad;
    }

    /**
     * @param string $cantidad
     */
    public function setCantidad(string $cantidad): void
    {
        $this->cantidad = $cantidad;
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
    public function getPrecioVenta(): int
    {
        return $this->precio_venta;
    }

    /**
     * @param int $precio_venta
     */
    public function setPrecioVenta(int $precio_venta): void
    {
        $this->precio_venta = $precio_venta;
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
     * @return int
     */
    public function getVentasIdventas(): int
    {
        return $this->ventas_idventas;
    }

    /**
     * @param int $ventas_idventas
     */
    public function setVentasIdventas(int $ventas_idventas): void
    {
        $this->ventas_idventas = $ventas_idventas;
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