<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TechniqueController extends JsonController
{

    /**
     * @Route("/techniques/{id}", name="techniques")
     * @Method("GET")
     */
    public function findTechnique($id)
    {
      return $this->jsonResponse(null);
    }

    /**
     * @Route("/categories/{id}/techniques", name="techniques")
     * @Method("GET")
     */
    public function findByCategory($id)
    {
      $techniques = $this->get("app.category_service")->findTechniques($id);
      return $this->jsonResponse($techniques);
    }

}
