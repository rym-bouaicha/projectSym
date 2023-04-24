<?php
namespace App\Repository;

use App\Entity\Rackvelo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Rackvelo|null find($idStation, $lockMode = null, $lockVersion = null)
 * @method Rackvelo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rackvelo[]    findAll()
 * @method Rackvelo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RackveloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rackvelo::class);
    }

    public function create(Rackvelo $rackvelo): void
    {
        $this->_em->persist($rackvelo);
        $this->_em->flush();
    }

    public function read(int $refRack): ?Rackvelo
    {
        return $this->find($refRack);
    }

    public function update(Rackvelo $rackvelo): void
    {
        $this->_em->flush();
    }
    public function getRacksByStation()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s.nomStation, COUNT(r) as rackCount
            FROM App\Entity\RackVelo r
            JOIN r.station s
            GROUP BY r.idStation'
        );

        return $query->getResult();
    }


}