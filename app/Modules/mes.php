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

class mes extends AbstractDBConnection implements Model
{

    /* Tipos de Datos => bool, int, float,  */
    private ?int $id;
    private string $enero;
    private string $febrero;
    private string $marzo;
    private string $abril;
    private string $mayo;
    private string $junio;
    private string $julio;
    private string $agosto;
    private string $septiembre;
    private string $octubre;
    private string $noviembre;
    private string $diciembre;
    private Carbon $updated_at;

    /**
     * @param int|null $id
     * @param string $enero
     * @param string $febrero
     * @param string $marzo
     * @param string $abril
     * @param string $mayo
     * @param string $junio
     * @param string $julio
     * @param string $agosto
     * @param string $septiembre
     * @param string $octubre
     * @param string $noviembre
     * @param string $diciembre
     * @param Carbon $updated_at
     */
    public function __construct(array $mes = [])
    {
        $this->setId($mes['id']?? NULL );
        $this->setEnero($mes['enero']?? '');
        $this->setFebrero($mes['febrero']?? '');
        $this->setMarzo($mes['marzo']?? '');
        $this->setAbril($mes['abril']?? '');
        $this->setMayo($mes['mayo']?? '');
        $this->setJunio($mes['junio']?? '');
        $this->setJulio($mes['julio']?? '');
        $this->setAgosto($mes['agosto']?? '');
        $this->setSeptiembre($mes['septiembre']?? '');
        $this->setOctubre($mes['octubre']?? '');
        $this->setNoviembre($mes['noviembre']?? '');
        $this->setDiciembre($mes['diciembre']?? '');
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
     * @return string
     */
    public function getEnero(): string
    {
        return $this->enero;
    }

    /**
     * @param string $enero
     */
    public function setEnero(string $enero): void
    {
        $this->enero = $enero;
    }

    /**
     * @return string
     */
    public function getFebrero(): string
    {
        return $this->febrero;
    }

    /**
     * @param string $febrero
     */
    public function setFebrero(string $febrero): void
    {
        $this->febrero = $febrero;
    }

    /**
     * @return string
     */
    public function getMarzo(): string
    {
        return $this->marzo;
    }

    /**
     * @param string $marzo
     */
    public function setMarzo(string $marzo): void
    {
        $this->marzo = $marzo;
    }

    /**
     * @return string
     */
    public function getAbril(): string
    {
        return $this->abril;
    }

    /**
     * @param string $abril
     */
    public function setAbril(string $abril): void
    {
        $this->abril = $abril;
    }

    /**
     * @return string
     */
    public function getMayo(): string
    {
        return $this->mayo;
    }

    /**
     * @param string $mayo
     */
    public function setMayo(string $mayo): void
    {
        $this->mayo = $mayo;
    }

    /**
     * @return string
     */
    public function getJunio(): string
    {
        return $this->junio;
    }

    /**
     * @param string $junio
     */
    public function setJunio(string $junio): void
    {
        $this->junio = $junio;
    }

    /**
     * @return string
     */
    public function getJulio(): string
    {
        return $this->julio;
    }

    /**
     * @param string $julio
     */
    public function setJulio(string $julio): void
    {
        $this->julio = $julio;
    }

    /**
     * @return string
     */
    public function getAgosto(): string
    {
        return $this->agosto;
    }

    /**
     * @param string $agosto
     */
    public function setAgosto(string $agosto): void
    {
        $this->agosto = $agosto;
    }

    /**
     * @return string
     */
    public function getSeptiembre(): string
    {
        return $this->septiembre;
    }

    /**
     * @param string $septiembre
     */
    public function setSeptiembre(string $septiembre): void
    {
        $this->septiembre = $septiembre;
    }

    /**
     * @return string
     */
    public function getOctubre(): string
    {
        return $this->octubre;
    }

    /**
     * @param string $octubre
     */
    public function setOctubre(string $octubre): void
    {
        $this->octubre = $octubre;
    }

    /**
     * @return string
     */
    public function getNoviembre(): string
    {
        return $this->noviembre;
    }

    /**
     * @param string $noviembre
     */
    public function setNoviembre(string $noviembre): void
    {
        $this->noviembre = $noviembre;
    }

    /**
     * @return string
     */
    public function getDiciembre(): string
    {
        return $this->diciembre;
    }

    /**
     * @param string $diciembre
     */
    public function setDiciembre(string $diciembre): void
    {
        $this->diciembre = $diciembre;
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
