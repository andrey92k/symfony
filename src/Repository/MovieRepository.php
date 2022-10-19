<?php

namespace App\Repository;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 *
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
        $this->entity = new Movie();
    }

    public function save(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Movie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function store(array $data): void
    {
        $this->entity
            ->setName($data['name'])
            ->setDescription($data['description'])
            ->setSlug($data['slug'])
            ->setFrame($data['frame'])
            ->setDataRelease($data['data_release']);

        foreach ($data['category'] as $item) {
            $category = $this->getEntityManager()->getRepository(Category::class)->find($item);
            $this->entity->addCategory($category);
        }

        foreach ($data['actor'] as $item) {
            $actor = $this->getEntityManager()->getRepository(Actor::class)->find($item);
            $this->entity->addActor($actor);
        }

        $this->save($this->entity, true);
    }

    public function update($id, $data)
    {
        $entity = $this->find($id);

        $entity
            ->setName($data['name'])
            ->setDescription($data['description'])
            ->setSlug($data['slug'])
            ->setFrame($data['frame'])
            ->setDataRelease($data['data_release']);

        $entity->removeAllCategories();
        $entity->removeAllActors();

        foreach ($data['category'] as $item) {
            $category = $this->getEntityManager()->getRepository(Category::class)->find($item);
            $entity->addCategory($category);
        }

        foreach ($data['actor'] as $item) {
            $category = $this->getEntityManager()->getRepository(Actor::class)->find($item);
            $entity->addActor($category);
        }

        $this->save($entity, true);
    }

//    /**
//     * @return Movie[] Returns an array of Movie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Movie
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
