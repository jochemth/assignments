<?php

namespace Oberon\AssignmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BreweryController extends Controller
{

  public function indexAction() 
  {
    return $this->render('OberonAssignmentBundle:brewery:index.html.twig');
  }

}