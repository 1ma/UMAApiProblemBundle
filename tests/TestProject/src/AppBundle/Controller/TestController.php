<?php

namespace TestProject\AppBundle\Controller;

use Crell\ApiProblem\ApiProblem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        return new ApiProblem('A problem occurred');
    }
}
