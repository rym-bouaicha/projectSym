<?php

namespace App\Entity;
use Doctrine\ORM\Mapping\JoinColumns ;
use Doctrine\DBAL\Schema\UniqueConstraint;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert; //We will be using this for the php Constraints

use App\Repository\RackveloRepository;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Index(columns: ["id_station"], name: "fk_idStation")]
#[ORM\Table(name: "rackvelo")]
#[ORM\Entity(repositoryClass: RackveloRepository::class)]
class Rackvelo
{

     #[ORM\Column(name:"Ref_rack", type:"integer", nullable:false)]
     #[ORM\Id]
     #[ORM\GeneratedValue(strategy:"IDENTITY")]
    private ?int $refRack;


     #[ORM\Column(name:"Capacite", type:"integer", nullable:false)]
     #[Assert\LessThanOrEqual(30)]
     #[Assert\GreaterThanOrEqual(10)]
    private ?int $capacite;


      #[ORM\Column(name:"modele", type:"integer", nullable:false)]
    private ?int $modele;



      #[ORM\ManyToOne(targetEntity:"Station")]
      #[ORM\JoinColumn(name:"id_station", referencedColumnName:"id_station")]
    private ?Station $idStation;

    /**
     * @return int|null
     */
    public function getRefRack(): ?int
    {
        return $this->refRack;
    }

    /**
     * @param int|null $refRack
     */
    public function setRefRack(?int $refRack): void
    {
        $this->refRack = $refRack;
    }

    /**
     * @return int|null
     */
    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    /**
     * @param int|null $capacite
     */
    public function setCapacite(?int $capacite): void
    {
        $this->capacite = $capacite;
    }

    /**
     * @return int|null
     */
    public function getModele(): ?int
    {
        return $this->modele;
    }

    /**
     * @param int|null $modele
     */
    public function setModele(?int $modele): void
    {
        $this->modele = $modele;
    }

    /**
     * @return Station|null
     */
    public function getIdStation(): ?Station
    {
        return $this->idStation;
    }

    /**
     * @param Station|null $idStation
     */
    public function setIdStation(?Station $idStation): void
    {
        $this->idStation = $idStation;
    }

      #[ORM\ManyToOne(targetEntity:"App\Entity\Station", inversedBy:"rackvelo")]
      #[ORM\JoinColumn(name:"id_station", referencedColumnName:"id_station", nullable:false)]
    private ?Station $station;

    // ...

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        $this->station = $station;

        return $this;
    }

}
