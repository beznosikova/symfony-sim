<?php

namespace AppBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
	public function findActiveByAlias($alias)
	{
		return $this
			->createQueryBuilder('product')
			->where("product.alias = :alias")
			->andWhere('product.active = true')
			->setParameter('alias', $alias)
			->getQuery()
			->getOneOrNullResult()
		;
	}
}
