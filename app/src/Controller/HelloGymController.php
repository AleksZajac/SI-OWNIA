<?php
/**
 * Hello Gym controller.
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HelloGymController.
 */
class HelloGymController extends AbstractController
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render(
            'hello-gym/index.html.twig');
    }
}