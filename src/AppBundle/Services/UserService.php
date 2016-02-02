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
                              'mail' => $mail
                            )
                          );

    if ($user && password_verify($password, $user->getPassword()))
    {
      $user->addAuthKey(uniqid());
      $this->em->persist($user);
      $this->em->flush();
    }

    return $user;
  }
  
  public function signup($token, $password)
  {
      $user = $this->findByToken($token);
      $user->updatePassword($password);
      $this->em->persist($user);
      $this->em->flush();

      return $user;
  }

  public function saveUser($user)
  {
    $grade = $this->em->getRepository('AppBundle:Grade')
            ->find($user->getGrade()->getId());
    $user->setGrade($grade);
    $user->setPassword('');
    $user->addAuthKey(uniqid());
    
    $this->em->persist($user);
    $this->em->flush();
    
    return $user;
    // todo: schedule registration mail leading to /signup/<token>
  }

  public function updateUser($id, $user)
  {
    if ($user && $id == $user->getId())
    {
      $persistedUser = $this->em->getRepository('AppBundle:User')
                        ->find($id);
      $entity = $this->em->merge($user);

      // password in user object is empty; reuse from persisted user
      $entity->setPassword($persistedUser->getPassword());

      $this->em->persist($entity);
      $this->em->flush();

      return $entity;
    }
    return null;
  }
}
