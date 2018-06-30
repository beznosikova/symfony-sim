<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Category;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    const PRODUCT_LIMIT = 6;

    public function findActive()
    {
        return $this
            ->createQueryBuilder('product')
            ->join('product.category', 'category')
            ->where("product.active = :active")
            ->andWhere('category.active = :active')
            ->setParameter('active', 1)
            ->orderBy('product.price', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

	public function findActiveByAlias($alias)
	{
		return $this
			->createQueryBuilder('product')
			->where("product.alias = :alias")
            ->setParameter('alias', $alias)
			->andWhere('product.active = :active')
            ->setParameter('active', 1)
			->getQuery()
			->getOneOrNullResult()
		;
	}

    public function findByCategory(Category $category)
    {
        return $this
            ->createQueryBuilder('product')
            ->where('product.active = :active')
            ->setParameter('active', 1)
            ->andWhere('product.category = :category')
            ->setParameter('category', $category)
            ->orderBy('product.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBySearchWord($searchWord)
    {
        return $this
            ->createQueryBuilder('product')
            ->where('product.active = :active')
            ->setParameter('active', 1)
            ->andWhere('product.title LIKE :searchWord')
            ->setParameter('searchWord', '%'.$searchWord.'%')
            ->orderBy('product.title', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByCategoryByPage(Category $category, $page, $sort)
    {
        extract($sort);
        return $this
            ->createQueryBuilder('product')
            ->where('product.active = :active')
            ->setParameter('active', 1)
            ->andWhere('product.category = :category')
            ->setParameter('category', $category)
            ->orderBy('product.'.$sortName, strtoupper($sortDirection))
            ->setFirstResult(self::PRODUCT_LIMIT * ($page-1)) // set the offset
            ->setMaxResults(self::PRODUCT_LIMIT) // set the limit
            ->getQuery()
            ->getResult()
        ;
    }
}
