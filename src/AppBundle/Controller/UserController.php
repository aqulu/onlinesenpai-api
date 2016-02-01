<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserController extends JsonController
{
    /**
     * @Route("/users", name="findusers")
     * @Method("GET")
     */
    public function findAllUsers()
    {
      $users = $this->getDoctrine()
                ->getRepository('AppBundle:User')
                ->findAll();
      return $this->jsonResponse($users);
    }

    /**
     * @Route("/users", name="createuser")
     * @Method("POST")
     */
    public function createUser(Request $request)
    {
      $data = $request->getContent();
      $user = $this->deserialize($data, 'AppBundle\Entity\User');
      if ($user != null)
      {
        $userService = $this->get("app.user_service");
        // TODO save associated entities as well (Grade)
        $userService->saveUser($user);
      }
    }

    /**
     * @Route("/users/{id}", name="updateuser")
     * @Method("PUT")
     */
    public function updateUser($id, Request $request)
    {
      $data = $request->getContent();
      $user = $this->deserialize($data, 'AppBundle\Entity\User');
      if ($user != null)
      {
        $userService = $this->get("app.user_service");
        $userService->updateUser($id, $user);
      }
    }
}