<?php
namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class UserService {
  private $em;

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }

  public function findByToken($token)
  {
    $token =  $this->em->getRepository('AppBundle:AuthKey')
                        ->findOneBy(array('token' => $token));
    return ($token) ? $token->getUser() : null;
  }

  public function login($mail, $password)
  {
    $user =  $this->em->getRepository('AppBundle:User')
                        ->findOneBy(
                            array(
                              'mail' => $mail,
                              'password' => $password
                            )
                          );
    if ($user)
    {
      $user->addAuthKey(uniqid());
      $this->em->persist($user);
      $this->em->flush();
    }

    return $user;
  }

  public function saveUser($user)
  {
    $grade = $this->em->getRepository('AppBundle:Grade')
            ->find($user->getGrade()->getId());
    $user->setGrade($grade);
    $this->em->persist($user);
    $this->em->flush();
  }

  public function updateUser($id, $user)
  {
    if ($user != null && $id == $user->getId())
    {
      $entity = $this->em->merge($user);
      $this->em->persist($entity);
      $this->em->flush();
      return $entity;
    }
    return null;
  }
}
