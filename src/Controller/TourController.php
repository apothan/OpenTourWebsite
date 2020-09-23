<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tour;
use App\Form\Type\AddTourType;
use App\Form\Type\EditTourType;

class TourController extends AbstractController
{
    /**
     * @Route("/Admin/AddTour", name="ot_admin_addtour")
     */
    public function addTour()
    {
        $entity = new Tour();
    	$tourForm = $this->createForm(AddTourType::class, $entity);

        return $this->render('addtour.html.twig', [
            'tourform' => $tourForm->createView(),
        ]);
    }

    /**
     * @Route("/Admin/CreateTour", name="ot_admin_createtour")
     */
    public function createTour(Request $request)
    {
    	$entity = new Tour();
    	$tourForm = $this->createForm(AddTourType::class, $entity);
    	$tourForm->handleRequest($request);
        
    	if ($tourForm->isValid()) {
            
    		$em = $this->getDoctrine()->getManager();
    		
    		$em->persist($entity);
    		$em->flush();
    
    		$this->get('session')->getFlashBag()->add('complete_message',"This tour has been created!");
    		return $this->redirect($this->generateUrl('ot_admin_edittour', array('id' => $entity->getId())));
    
    	}
    
    	return $this->render('addtour.html.twig', [
            'tourform' => $tourForm->createView(),
        ]);
    }

    /**
     * @Route("/Admin/EditTour/{id}", name="ot_admin_edittour")
     */
    public function editTour($id)
    {
        $em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository(Tour::class)->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find tour entity.');
        }
        
    	$tourForm = $this->createForm(EditTourType::class, $entity);

        return $this->render('edittour.html.twig', [
            'tourform' => $tourForm->createView(),
            'tour' => $entity,
        ]);
    }

    /**
     * @Route("/Admin/UpdateTour/{id}", name="ot_admin_updatetour")
     */
    public function updateTour($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository(Tour::class)->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find tour entity.');
        }

    	$tourForm = $this->createForm(EditTourType::class, $entity);
    	$tourForm->handleRequest($request);
    
    	if ($tourForm->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		
    		$em->persist($entity);
    		$em->flush();
    
    		$this->get('session')->getFlashBag()->add('complete_message',"This tour has been updated!");
    		return $this->redirect($this->generateUrl('ot_admin_edittour', array('id' => $entity->getId())));
    
    	}
    
    	return $this->render('edittour.html.twig', [
            'tourform' => $tourForm->createView(),
            'tour' => $entity,
        ]);
    }
}