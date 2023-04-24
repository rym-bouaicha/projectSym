<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement", indexes={@ORM\Index(name="fk_l", columns={"Id_offre"})})
 * @ORM\Entity
 */
class Abonnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_ab", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAb;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_ab", type="string", length=30, nullable=false)
     */
    private $typeAb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix_ab", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixAb;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Id_offre", type="integer", nullable=true)
     */
    private $idOffre;


}
