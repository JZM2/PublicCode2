<?php

namespace App\Repository;

use App\Entity\Log;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Log|null find($id, $lockMode = null, $lockVersion = null)
 * @method Log|null findOneBy(array $criteria, array $orderBy = null)
 * @method Log[]    findAll()
 * @method Log[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogRepository extends ServiceEntityRepository {

	public function __construct(RegistryInterface $registry) {
		parent::__construct($registry, Log::class);
	}

	// /**
	//  * @return Log[] Returns an array of Log objects
	//  */
	/*
	  public function findByExampleField($value)
	  {
	  return $this->createQueryBuilder('l')
	  ->andWhere('l.exampleField = :val')
	  ->setParameter('val', $value)
	  ->orderBy('l.id', 'ASC')
	  ->setMaxResults(10)
	  ->getQuery()
	  ->getResult()
	  ;
	  }
	 */

	/*
	  public function findOneBySomeField($value): ?Log
	  {
	  return $this->createQueryBuilder('l')
	  ->andWhere('l.exampleField = :val')
	  ->setParameter('val', $value)
	  ->getQuery()
	  ->getOneOrNullResult()
	  ;
	  }
	 */

	/**
	 * 
	 * @return Log[] Retursn an array of Log objects
	 * @param type $value
	 */
	public function findOrderByNum($idFolder) {
		$entityManager = $this->getEntityManager();
		
		$query = $entityManager->createQuery(
						'SELECT l
							FROM App\Entity\Log l
							WHERE l.folderId = :folderId
							ORDER BY l.logMyNum ASC'
				)->setParameter('folderId', $idFolder);
		return $query->execute();
	}

}
