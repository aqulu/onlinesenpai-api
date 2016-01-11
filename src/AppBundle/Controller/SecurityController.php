<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SecurityController extends JsonController
{
    /**
     * @Route("/login", name="login")
     * @Method("POST")
     */
    public function loginAction(Request $request)
    {
      $content = json_decode($request->getContent());

      if ($content->mail != null && $content->password != null)
      {
        $userService = $this->get("app.user_service");
        $user = $userService->login($content->mail, $content->password);

        // TODO anders an key kommen
        return $this->jsonResponse(array(
          "token" => $user->getAuthKeys()->first(),
          "user" => $user
        ));
      }

      return $this->jsonResponse(array("message" => "login failed!"), 401 );
    }
}
