<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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
      
      if ($user)
      {
        $userService = $this->get("app.user_service");
        $result = $userService->saveUser($user);
      }
      
      return $this->jsonResponse($result, ($result) ? 200 : 406);
    }

    /**
     * @Route("/users/{id}", name="updateuser")
     * @Method("PUT")
     * @Security("has_role('ROLE_ADMIN') or user.getId() == id")
     */
    public function updateUser($id, Request $request)
    {
      $data = $request->getContent();
      $user = $this->deserialize($data, 'AppBundle\Entity\User');

      if ($user)
      {
        $userService = $this->get("app.user_service");
        $result = $userService->updateUser($id, $user);
      }
      return $this->jsonResponse($result, ($result) ? 200 : 406);
    }
}
