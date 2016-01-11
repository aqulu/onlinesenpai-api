<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder;

abstract class JsonController extends Controller
{
  protected $serializer;

  public function __construct()
  {
    $this->serializer = SerializerBuilder::create()->build();
  }

  protected function jsonResponse($data, $status=200)
  {
    return new Response($this->serializer->serialize($data, 'json'), $status, array('content-type' => 'application/json'));
  }

  protected function deserialize($data, $classname)
  {
    return $this->serializer->deserialize($data, $classname, 'json');
  }
}
