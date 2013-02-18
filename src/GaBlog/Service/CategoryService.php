<?php
namespace GaBlog\Service;

use GaBlog\Entity\Category as CategoryEntity;
use Doctrine\ORM\EntityManager;
use GaBlog\Entity\Category;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Class CategoryService
 * This is a manage of Category
 */
class CategoryService
{
    /**
     * Manager of Doctrine Entities
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * Category Entity
     * @var Category;
     */
    protected $categoryEntity;

    /**
     * Resume entity Manager of doctrine
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return CategoryEntity Obj
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->categoryEntity = $this->em->getRepository('GaBlog\Entity\Category');
        return $this;
    }

    /**
     * return all records from Category table
     * or only one record by id
     * @param $id integer
     */
    public function find($id = null)
    {
        if($id){
            return $this->categoryEntity->find($id);
        } else {
            return $this->categoryEntity->findAll();
        }
    }

    /**
     * Insert date into database
     * @param $data array
     * @param $persist boolean
     */
    public function insert(array $data, $persist = true)
    {
        $hydrator = new ClassMethods();
        $category = new Category();
        $category = $hydrator->hydrate($data, $category);
        $rs = null;
        if($persist){
            $this->em->persist($category);
            $rs = $this->em->flush();
        }
        return $rs;
    }

    public function update($id, $data, $persist = true)
    {
        $category = $this->categoryEntity->find($id);
        $category->setName($data['name']);
        $category->setTag($data['tag']);
        $category->setDescription($data['description']);
        $category->setUser($data['user']);
        $rs = null;
        if($persist){
            $this->em->persist($category);
            $rs = $this->em->flush();
        }
        return $rs;
    }
    /**
     * Delete from database a record with param id
     * @param $id integer
     */
    public function delete($id)
    {
        $category = $this->find($id);
        $this->em->remove($category);
        $this->em->flush();
    }
}