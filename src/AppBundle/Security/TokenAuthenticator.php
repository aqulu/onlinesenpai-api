<?php
namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use AppBundle\Services\UserService;

class TokenAuthenticator extends AbstractGuardAuthenticator
{
  private $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  public function getCredentials(Request $request)
  {
    if (!$token = $request->headers->get('X-AUTH-TOKEN'))
    {
      return;
    }

    return array( 'token' => $token );
  }

  public function getUser($credentials, UserProviderInterface $user)
  {
    return $this->userService->findByToken($credentials['token']);
  }


  public function checkCredentials($credentials, UserInterface $user)
  {
    return true;
  }


  public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
  {
    return null;
  }


  public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
  {
    $data = array(
        'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
    );

    return new JsonResponse($data, 403);
  }


  public function start(Request $request, AuthenticationException $authException = null)
  {
    $data = array(
        'message' => 'Authentication Required'
    );

    return new JsonResponse($data, 401);
  }


  public function supportsRememberMe()
  {
    return false;
  }
}
