<?php
namespace GaBlog\Service;

use GaBlog\Entity\Category as CategoryEntity;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoryService
{
    /**
     * Manager of Doctrine Entities
     */
    protected $em;

    /**
     * Resume entity Manager of doctrine
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return CategoryEntity Obj
     */
    public function getEntityManager(ServiceLocatorInterface $serviceLocator)
    {
        return $this->em = $this->getServiceLocator()->
            get('Doctrine\ORM\EntityManager')->getRepository('GaBlog\Entity\Category');
    }

    /**
     * return all records from Categort table
     * or only one record by id
     */
    public function find($id = null)
    {

    }

    /**
     *
     * @param $data
     */
    public function insert($data)
    {

    }

    /**
     * @param $date
     */
    public function update($date)
    {

    }

    /**
     * @param $entity CategoryEntity
     */
    public function delete($entity)
    {

    }
}