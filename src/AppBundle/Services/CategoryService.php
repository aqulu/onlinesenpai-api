<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class CategoryService {
  private $em;

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }

  public function findAll()
  {
    return $this->em->getRepository('AppBundle:Category')->findAll();
  }

  public function findTechniques($id)
  {
    if ($id)
      $category = $this->em->getRepository('AppBundle:Category')->find($id);

    return ($category) ? $category->getTechniques() : null;
  }

}
