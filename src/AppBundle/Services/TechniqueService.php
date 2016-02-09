<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class TechniqueService {
  private $em;

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }

  public function find($id)
  {
    return $this->em->getRepository('AppBundle:Technique')->find($id);
  }

  public function updateTechnique($id, $technique)
  {
    // TODO: implement me
    return null;
  }

  public function createTechnique($technique)
  {
    // TODO: implement me
    return null;
  }

}
