<?php
// src/AppBundle/Entity/User.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Type;
use AppBundle\Entity\AuthKey;
use AppBundle\Entity\Grade;

/**
* @ORM\Entity
* @ORM\Table(name="users")
* @ExclusionPolicy("all")
*/
class User implements UserInterface
{
  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  * @Expose
  * @Type("integer")
  */
  private $id;

  /**
  * @ORM\Column(type="string", length=25)
  * @Expose
  * @Type("string")
  */
  private $firstname;

  /**
  * @ORM\Column(type="string", length=50)
  * @Expose
  * @Type("string")
  */
  private $lastname;

  /**
  * @ORM\Column(type="string", length=100)
  * @Expose
  * @Type("string")
  */
  private $mail;

  /**
  * @ORM\Column(type="string", length=50)
  */
  private $password;

  /**
  * @ORM\Column(type="boolean")
  * @Expose
  * @Type("boolean")
  */
  private $instructor;

  /**
  * @ORM\ManyToOne(targetEntity="Grade", fetch="EAGER", cascade={})
  * @ORM\JoinColumn(name="grade_id", referencedColumnName="id")
  * @Expose
  * @Type("AppBundle\Entity\Grade")
  */
  private $grade;

  /**
  * @ORM\OneToMany(targetEntity="AuthKey", mappedBy="user", fetch="EAGER", cascade={"all"})
  */
  private $authkeys;

  public function getId()
  {
    return $this->id;
  }

  public function getAuthKeys()
  {
    return $this->authkeys;
  }

  public function addAuthKey($key)
  {
    if (!$this->authkeys)
    {
      $this->authkeys = new ArrayCollection();
    }

    $this->authkeys->add(new AuthKey($key, $this));
    if ($this->authkeys->count() > 5)
    {
      $this->authkeys = $this->authkeys->slice(0, 5);
    }
  }

  public function getGrade()
  {
    return $this->grade;
  }

  public function setGrade($grade)
  {
    $this->grade = $grade;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  /**
  * creates hash from cleartext password parameter using php password_hash function
  */
  public function updatePassword($password)
  {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  // IFC Implementations
  public function getPassword()
  {
    return $this->password;
  }

  public function getUsername()
  {
    return $this->mail;
  }

  public function getRoles()
  {
    if ($this->instructor)
      return ['ROLE_ADMIN'];
    else
      return ['ROLE_USER'];
  }

  public function getSalt()
  {
    return null;
  }

  public function eraseCredentials()
  {   }
}
