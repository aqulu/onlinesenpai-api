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
    $grade = $this->em->getRepository('AppBundle:Grade')->find($user->getGrade()->getId());
    $user->setGrade($grade);
    $user->setPassword('');
    $user->addAuthKey(uniqid());
    if ($user->isInstructor() == null)
      $user->setInstructor(false);

    $this->em->persist($user);
    $this->em->flush();

    // todo: schedule registration mail leading to /signup/<token>
    return $user;
  }

  public function updateUser($id, $user)
  {
    if ($user && $id == $user->getId())
    {
      $entity = $this->em->getRepository('AppBundle:User')->find($id);

      if ($user->getFirstname() && $entity->getFirstname() != $user->getFirstname())
        $entity->setFirstname($user->getFirstname());

      if ($user->getLastname() && $entity->getLastname() != $user->getLastname())
        $entity->setLastname($user->getLastname());

      if ($user->getMail() && $entity->getMail() != $user->getMail())
        $entity->setMail($user->getMail());

      if ($user->getPassword())
        $entity->updatePassword($user->getPassword());

      if ($user->getGrade() && $entity->getGrade()->getId() != $user->getGrade()->getId())
      {
        $grade = $this->em->getRepository('AppBundle:Grade')->find($user->getGrade()->getId());
        $entity->setGrade($grade);
      }

      $this->em->persist($entity);
      $this->em->flush();
    }

    return $entity;
  }
}
