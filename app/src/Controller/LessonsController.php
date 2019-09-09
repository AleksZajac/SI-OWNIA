<?php
/**
 * Lessons controller.
 */

namespace App\Controller;

use App\Repository\LessonsRepositroy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LessonsController.
 *
 * @Route("/lessons")
 */
class LessonsController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \App\Repository\LessonsRepositroy $repository Repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="lessons_index"
     * )
     */
    public function index(LessonsRepositroy $repository): Response
    {
        return $this->render(
            'lessons/index.html.twig',
            ['data' => $repository->findAll()]
        );
    }
    /**
     * View action.
     *
     * @param \App\Repository\LessonsRepositroy $repository Repository
     * @param int                            $id         Element Id
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{id}",
     *     name="test_view",
     *     requirements={"id": "[1-9]\d*"},
     * )
     */
    public function view(LessonsRepositroy $repository, int $id): Response
    {
        return $this->render(
            'lessons/view.html.twig',
            ['item' => $repository->findById($id)]
        );
    }
}