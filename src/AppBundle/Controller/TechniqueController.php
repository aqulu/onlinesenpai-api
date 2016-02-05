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
    public function findCategories()
    {
      $categories = $this->get("app.technique_service")->findCategories();
      return $this->jsonResponse($categories);
    }

    /**
     * @Route("/categories/{id}/techniques", name="techniques")
     * @Method("GET")
     */
    public function findByCategory($id)
    {
      $techniques = $this->get("app.technique_service")->findByCategory($id);
      return $this->jsonResponse($techniques);
    }
}
