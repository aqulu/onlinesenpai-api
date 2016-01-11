<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;

/**
* @ORM\Entity
* @ORM\Table(name="grades")
*/
class Grade {
  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  * @Type("integer")
  */
  private $id;

  /**
  * @ORM\Column(type="integer")
  * @Type("integer")
  */
  private $grade;

  /**
  * @ORM\Column(type="string", length=3)
  * @Type("string")
  */
  private $level;

  /**
  * @ORM\Column(type="string", length=7, name="color_hex")
  * @Type("string")
  */
  private $color_hex;

  /**
  * @ORM\ManyToMany(targetEntity="Technique", cascade={"remove", "persist"})
  * @ORM\JoinTable(
  *   name="programs",
  *   joinColumns={ @ORM\JoinColumn(name="grade_id", referencedColumnName="id") },
  *   inverseJoinColumns={ @ORM\JoinColumn(name="technique_id", referencedColumnName="id") }
  * )
  * @Exclude
  */
  private $techniques;

  public function getTechniques()
  {
    return $this->techniques;
  }

  public function getId()
  {
    return $this->id;
  }
}
