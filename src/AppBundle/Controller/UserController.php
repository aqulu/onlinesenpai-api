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
      $users = $this->get("app.user_service")->findAll();
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
        $result = $this->get("app.user_service")->saveUser($user);

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
        $result = $this->get("app.user_service")->updateUser($id, $user);

      return $this->jsonResponse($result, ($result) ? 200 : 406);
    }
}
