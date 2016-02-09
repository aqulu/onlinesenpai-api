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
      $technique = $this->get("app.technique_service")->find($id);
      return $this->jsonResponse($technique);
    }

    /**
     * @Route("/techniques/{id}", name="updateTechnique")
     * @Method("PUT")
     */
    public function updateTechnique($id, Request $request)
    {
      $technique = $this->deserialize($request->getContent(), 'AppBundle\Entity\Technique');
      if ($technique)
        $result = $this->get("app.technique_service")->updateTechnique($id, $technique);
      return $this->jsonResponse($result, ($result) ? 201 : 406);
    }

    /**
     * @Route("/techniques", name="createTechnique")
     * @Method("POST")
     */
    public function createTechnique(Request $request)
    {
      $technique = $this->deserialize($request->getContent(), 'AppBundle\Entity\Technique');
      if ($technique)
        $result = $this->get("app.technique_service")->createTechnique($technique);
      return $this->jsonResponse($result, ($result) ? 201 : 406);
    }

}
