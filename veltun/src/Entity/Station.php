<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StationRepository;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: StationRepository::class)]
class Station
{
    /**
     * @return int|null
     */
    public function getIdStation(): ?int
    {
        return $this->id_station;
    }

    /**
     * @param int|null $id_station
     */
    public function setIdStation(?int $id_station): void
    {
        $this->id_station = $id_station;
    }

    /**
     * @return string|null
     */

    public function getNomStation(): ?string
    {
        return $this->nomStation;
    }

    /**
     * @param string|null $nomStation
     */
    public function setNomStation(?string $nomStation): void
    {
        $this->nomStation = $nomStation;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     */
    public function setLongitude(?float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     */
    public function setLatitude(?float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string|null
     */
    public function getGouvernorat(): ?string
    {
        return $this->gouvernorat;
    }

    /**
     * @param string|null $gouvernorat
     */
    public function setGouvernorat(?string $gouvernorat): void
    {
        $this->gouvernorat = $gouvernorat;
    }

    #[ORM\Column(name:"id_station", type:"integer", nullable:false)]
    #[ORM\Id]
     #[ORM\GeneratedValue(strategy:"IDENTITY")]

    private ?int $id_station;



      #[ORM\Column(name:"Nom_station", type:"string", length:30, nullable:false)]
      #[Assert\NotBlank(message: "The name field cannot be empty")]
      #[Assert\Length(
          min: 5,
          max: 50,
          minMessage: 'The station name must be at least {{ limit }} characters long',
          maxMessage: 'Your station name cannot be longer than {{ limit }} characters',
      )]
     // #[Assert\Unique(message: "A station with this name already exists")]
    private ?string $nomStation;


      #[ORM\Column(name:"longitude", type:"float", precision:30, scale:30, nullable:true)]
      #[Assert\NotBlank(message: "The longitude's field cannot be empty")]
    private ?float $longitude;


      #[ORM\Column(name:"latitude", type:"float", precision:30, scale:30, nullable:true)]
      #[Assert\NotBlank(message: "The latitude's field cannot be empty")]
    private ?float $latitude;


      #[ORM\Column(name:"gouvernorat", type:"string", length:50, nullable:false)]
      #[Assert\NotBlank(message: "The district's name field cannot be empty")]

      private ?string $gouvernorat;

    public function __toString(): string
    {
       return $this -> nomStation ;
    }


}
