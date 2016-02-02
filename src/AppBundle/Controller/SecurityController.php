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

      if ($content->mail && $content->password)
      {
        $userService = $this->get("app.user_service");
        $user = $userService->login($content->mail, $content->password);
        if ($user != null) {
          return $this->jsonResponse(array(
            "token" => $user->getAuthKeys()->first(),
            "user" => $user
          ));
        }
      }

      return $this->jsonResponse(array("message" => "login failed!"), 401 );
    }
    
    /**
     * @Route("/signup", name="signup")
     * @Method("PUT")
     */
    public function signup(Request $request)
    {
      $userService = $this->get("app.user_service");
      $content = json_decode($request->getContent());
      $token = $request->headers->get('X-AUTH-TOKEN');
      
      if ($token && $content->password) 
      {
        $user = $userService->signup($token, $content->password);
        return $this->jsonResponse(array(
            "token" => $user->getAuthKeys()->first(),
            "user" => $user
        ));
      }
      
      return $this->jsonResponse(array("message" => "signup failed!"), 401 );
    }
}
