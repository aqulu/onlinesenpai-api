<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Accessor;

/**
* @ORM\Entity
* @ORM\Table(name="categories")
*/
class Category
{
  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  */
  private $id;

  /**
  * @ORM\Column(type="string", length=20)
  */
  private $name;

  /**
  * @ORM\OneToMany(targetEntity="Technique", mappedBy="category", cascade={"all"})
  * @Accessor(getter="getTechniques")
  */
  private $techniques;

  public function getTechniques()
  {
    return ($this->techniques) ? $this->techniques->toArray() : array();
  }

  public function addTechnique($technique)
  {
    if (!$this->techniques)
    {
      $this->techniques = new ArrayCollection();
    }

    $technique->setCategory($this);
    $this->techniques->add($technique);
  }
}
