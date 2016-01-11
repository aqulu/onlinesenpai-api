<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GradeController extends JsonController
{
    /**
     * @Route("/grades", name="grades")
     * @Method("GET")
     */
    public function findAllGrades()
    {
      $grades = $this->getDoctrine()
                ->getRepository('AppBundle:Grade')
                ->findAll();
      return $this->jsonResponse($grades);
    }


    /**
    * @Route("/grades/{id}/techniques", name="program")
    * @Method("GET")
    */
    public function getProgramForTechnique($id)
    {
      $grade = $this->getDoctrine()
                ->getRepository('AppBundle:Grade')
                ->find($id);
      return $this->jsonResponse($grade->getTechniques());
    }
}
