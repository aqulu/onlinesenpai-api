<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="techniques")
*/
class Technique
{
  /**
  * @ORM\Column(type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  private $id;

  /**
  * @ORM\Column(type="string", length=25)
  */
  private $name;

  /**
  * @ORM\Column(type="string")
  */
  private $description;

  /**
  * @ORM\Column(type="string", length=50)
  */
  private $video_url;

  /**
  * @ORM\ManyToOne(targetEntity="Category", inversedBy="techniques")
  * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
  */
  private $category;

  public function setCategory($category)
  {
    $this->category = $category;
  }

}
