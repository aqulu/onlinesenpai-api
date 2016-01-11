<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TechniqueController extends JsonController
{

    /**
     * @Route("/categories", name="categories")
     * @Method("GET")
     */
    public function findAllCategories()
    {
      $categories = $this->getDoctrine()
                ->getRepository('AppBundle:Category')
                ->findAll();
      return $this->jsonResponse($categories);
    }

    /**
     * @Route("/categories/{id}/techniques", name="techniques")
     * @Method("GET")
     */
    public function findTechniques($id)
    {
      if ($id)
      {
        $category = $this->getDoctrine()
                        ->getRepository('AppBundle:Category')
                        ->find($id);
        return ($category != null) ? $this->jsonResponse($category->techniques) : null;
      }
      return null;
    }
}
