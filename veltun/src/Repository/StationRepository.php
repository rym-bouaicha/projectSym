<?php
namespace App\Repository;

use App\Entity\Station;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Station|null find($idStation, $lockMode = null, $lockVersion = null)
 * @method Station|null findOneBy(array $criteria, array $orderBy = null)
 * @method Station[]    findAll()
 * @method Station[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Station::class);
    }

    public function create(Station $station): void
    {
        $this->_em->persist($station);
        $this->_em->flush();
    }

    public function read(int $idStation): ?Station
    {
        return $this->find($idStation);
    }

    public function update(Station $station): void
    {
        $this->_em->flush();
    }
}