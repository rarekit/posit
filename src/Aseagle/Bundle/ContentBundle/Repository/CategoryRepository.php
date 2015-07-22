<?php

namespace Aseagle\Bundle\ContentBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends NestedTreeRepository {

    /**
     *
     * @param array $criteria            
     * @param string $orderBy            
     * @param string $limit            
     * @param string $offset            
     * @return Ambigous <\Doctrine\ORM\mixed, \Aseagle\Bundle\UserBundle\Repository\multitype:>
     */
    public function getList($criteria, $orderBy = null, $limit = null, $offset = null) {
        return $this->search($criteria, $orderBy, $limit, $offset);
    }

    /**
     *
     * @param array $criteria            
     * @return Ambigous <\Doctrine\ORM\mixed, \Aseagle\Bundle\UserBundle\Repository\multitype:>
     */
    public function getTotal($criteria) {
        return $this->search($criteria, array (), null, null, true);
    }

    /**
     *
     * @param array $criteria            
     * @param array $orderBy            
     * @param integer $limit            
     * @param integer $offset            
     * @param string $count            
     * @return \Doctrine\ORM\mixed|multitype:
     */
    public function search($criteria, $orderBy, $limit, $offset, $count = false) {
        $query = $this->createQueryBuilder('o');
        if ($count) {
            $query->select('COUNT(o.id)');
        }
        
        $where = 'where';
        foreach ($criteria as $key => $value) {
            if (is_numeric($value)) {
                $query->$where("o.$key = :$key")->setParameter($key, $value);
            } elseif ($value instanceof \DateTime) {
                switch ($key) {
                    case 'created_from' :
                        $query->$where("o.created >= :$key")->setParameter($key, $value->format('Y-m-d') . ' 00:00:00');
                        break;
                    case 'created_to' :
                        $query->$where("o.created <= :$key")->setParameter($key, $value->format('Y-m-d') . ' 23:59:59');
                        break;
                    default :
                        $query->$where("o.$key = :$key")->setParameter($key, $value->format('Y-m-d'));
                }
            } elseif (is_string($value)) {
                
                $query->$where("o.$key LIKE :$key")->setParameter($key, "%$value%");
            } elseif (is_array($value)) {
                
                $query->$where("o.$key IN (:$key)")->setParameter($key, $value);
            } elseif (is_object($value)) {
                
                $query->$where("o.$key = :$key")->setParameter($key, $value->getId());
            } else {
                if ($value == null && $key == 'parent') {
                    $query->$where("o.$key is NULL");
                } elseif ($value != null) {
                    $query->$where("o.$key = :$key")->setParameter($key, $value);
                }
            }
            $where = 'andWhere';
        }       

        $query->orderBy('o.root, o.lft, o.ordering', 'ASC');
        
        if ($limit) {
            $query->setMaxResults((int) $limit);
            $query->setFirstResult((int) $offset);
        }
        
        if ($count) {
            return $query->getQuery()->getSingleScalarResult();
        } else {
            return $query->getQuery()->getResult();
        }
    }
    
}


