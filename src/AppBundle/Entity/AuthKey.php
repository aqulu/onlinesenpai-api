<?php
namespace AppBundle\Entity;

use \DateTime;
use \DateInterval;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
* @ORM\Entity
* @ORM\Table(name="authkeys")
* @ExclusionPolicy("all")
*/
class AuthKey {

  public function __construct($token, $user)
  {
    $this->token = $token;
    $date = new DateTime();
    $this->expires = $date;
    $this->user = $user;
  }

  /**
  * @ORM\Column(type="string", length=50)
  * @ORM\Id
  * @Expose
  */
  private $token;

  /**
  * @ORM\Column(type="datetime")
  * @Expose
  */
  private $expires;

  /**
  * @ORM\ManyToOne(targetEntity="User", inversedBy="authkeys", fetch="EAGER")
  * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
  */
  private $user;

  public function getUser() {
    return $this->user;
  }
}
