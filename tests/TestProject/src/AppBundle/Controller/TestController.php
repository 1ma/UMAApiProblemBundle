<?php

namespace TestProject\AppBundle\Controller;

use Crell\ApiProblem\ApiProblem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{
    public function indexAction(Request $request)
    {
        if ($request->query->has('trigger_generic_problem')) {

            // An ApiProblem with no explicit status will return the
            // HTTP status code defined at uma_api_problem.default_status,
            // which is 400 when not specified in the configuration file.
            // In this project it is set to 500.
            return new ApiProblem('Oops! An error occurred');
        }

        if ($request->query->has('trigger_downtime')) {

            // This is meant to test that the 503 HTTP status code takes
            // precedence over the default 500.
            $problem = new ApiProblem('Be back soon!');
            $problem->setStatus(Response::HTTP_SERVICE_UNAVAILABLE);

            return $problem;
        }

        if ($request->query->has('trigger_exception')) {

            // This string could in principle be converted to a Symfony Response
            // by another VIEW event listener. In this fake project there is no such
            // listener, so this will trigger a \LogicException down the line.
            // It is just meant to test that the ApiProblemListener does nothing with
            // non-ApiProblem return values from the controller.
            return 'boom';
        }

        return new JsonResponse('Relax, everything is fine');
    }
}
