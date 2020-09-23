<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tour;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="ot_home")
     */
    public function index()
    {
        $tours = $this->getDoctrine()->getRepository(Tour::class)->getThree();
        
        return $this->render('index.html.twig', [
            'tours' => $tours,
        ]);
    }

    /**
     * @Route("/Tour/{id}", name="ot_tour")
     */
    public function tour($id)
    {
        $tour = $this->getDoctrine()->getRepository(Tour::class)->find($id);
        
        return $this->render('tour.html.twig', [
            'tour' => $tour,
        ]);
    }
}