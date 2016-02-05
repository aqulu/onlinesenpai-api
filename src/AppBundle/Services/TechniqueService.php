<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class TechniqueService {
  private $em;

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }

  public function findCategories()
  {
    return $this->getRepository('AppBundle:Category')->findAll();
  }

  public function findByCategory($id)
  {
    if ($id)
      $category = $this->getRepository('AppBundle:Category')->find($id);

    return ($category) ? $category->getTechniques() : null;
  }
}
