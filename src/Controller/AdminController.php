<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tour;

class AdminController extends AbstractController
{
    /**
     * @Route("/Admin", name="ot_admin")
     */
    public function index()
    {
        $tours = $this->getDoctrine()->getRepository(Tour::class)->findAll();

        return $this->render('admin.html.twig', [
            'tours' => $tours
        ]);
    }
}