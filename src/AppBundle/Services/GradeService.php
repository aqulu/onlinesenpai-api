<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class GradeService {
  private $em;

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }

  public function findAll()
  {
    return $this->getRepository('AppBundle:Grade')->findAll();
  }

  public function findTechniques($id)
  {
    if ($id)
      $grade = $this->getRepository('AppBundle:Grade')->find($id);

    return ($grade) ? $grade->getTechniques() : null;
  }
}
