<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tour;
use App\Entity\SellDateBreak;
use App\Entity\SellAmount;
use App\Form\Type\AddTourType;
use App\Form\Type\EditTourType;
use App\Form\Type\TourCategoriesType;
use App\Form\Type\TourSellsType;
use App\Form\Type\TourBreakAddType;
use App\Form\Type\TourFeaturesType;
use App\Form\Type\TourItineraryType;

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

    /**
     * @Route("/Admin/TourCategories/{id}", name="ot_admin_tourcategories")
     */
    public function tourCategories($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository(Tour::class)->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find tour entity.');
        }

    	$tourForm = $this->createForm(TourCategoriesType::class, $entity);
    	$tourForm->handleRequest($request);
    
    	if ($tourForm->isSubmitted() && $tourForm->isValid()) {
    		// filter $originalTags to contain tags no longer present
            foreach ($entity->getCategories() as $category)
            {
                $category->setTour($entity);
                if (isset($originalCategories))
                    foreach ($originalCategories as $key => $toDel)
                    {
                        if ($toDel->getId() === $category->getId())
                        {
                            unset($originalCategories[$key]);
                        }
                    }
            }

            // remove the relationship between the tag and the Task
            if (isset($originalCategories))
                foreach ($originalCategories as $category)
                {
                    // remove the Task from the Tag
                    //$passenger->getTasks()->removeElement($entity);
                    // if it were a ManyToOne relationship, remove the relationship like this
                    //$tag->setTask(null);

                    $em->persist($category);

                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($category);
                }

            $em->persist($entity);
            $em->flush();
    
    		$this->get('session')->getFlashBag()->add('complete_message',"This tour has been updated!");
    		return $this->redirect($this->generateUrl('ot_admin_tourcategories', array('id' => $entity->getId())));
    
    	}
    
    	return $this->render('tourcategories.html.twig', [
            'tourform' => $tourForm->createView(),
            'tour' => $entity,
        ]);
    }

    
    /**
     * @Route("/Admin/TourSells/{id}", name="ot_admin_toursells")
     */
    public function tourSells($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository(Tour::class)->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find tour entity.');
        }

        $sellbreak = new SellDateBreak();
        $sellbreak->setTour($entity);
        foreach ($entity->getCategories() as $cat)
        {
            $newsell = new SellAmount();
            $newsell->setTourcategory($cat);
            $sellbreak->addSellamount($newsell);
        }
        $breakAddForm = $this->createForm(TourBreakAddType::class, $sellbreak);
    	$tourForm = $this->createForm(TourSellsType::class, $entity);
    	$tourForm->handleRequest($request);
    
    	if ($tourForm->isSubmitted() && $tourForm->isValid()) {
    		// filter $originalTags to contain tags no longer present
            foreach ($entity->getSelldatebreaks() as $break)
            {
                $break->setTour($entity);
                if (isset($originalCategories))
                    foreach ($originalSelldatebreaks as $key => $toDel)
                    {
                        if ($toDel->getId() === $break->getId())
                        {
                            unset($originalSelldatebreaks[$key]);
                        }
                    }
            }

            // remove the relationship between the tag and the Task
            if (isset($originalSelldatebreaks))
                foreach ($originalSelldatebreaks as $break)
                {
                    // remove the Task from the Tag
                    //$passenger->getTasks()->removeElement($entity);
                    // if it were a ManyToOne relationship, remove the relationship like this
                    //$tag->setTask(null);

                    $em->persist($break);

                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($break);
                }
    		
    		$em->persist($entity);
    		$em->flush();
    
    		$this->get('session')->getFlashBag()->add('complete_message',"This tour has been updated!");
    		return $this->redirect($this->generateUrl('ot_admin_toursells', array('id' => $entity->getId())));
    
    	}
    
    	return $this->render('toursells.html.twig', [
            'tourform' => $tourForm->createView(),
            'breakaddform' => $breakAddForm->createView(),
            'tour' => $entity,
        ]);
    }

    /**
     * @Route("/Admin/TourSellAdd/{id}", name="ot_admin_tourselladd")
     */
    public function tourSellAdd($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository(Tour::class)->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find tour entity.');
        }

        $sellbreak = new SellDateBreak();
        $sellbreak->setTour($entity);
        foreach ($entity->getCategories() as $cat)
        {
            $newsell = new SellAmount();
            $newsell->setTourcategory($cat);
            $sellbreak->addSellamount($newsell);
        }
        $breakAddForm = $this->createForm(TourBreakAddType::class, $sellbreak);

        $breakAddForm->handleRequest($request);
    
    	if ($breakAddForm->isSubmitted() && $breakAddForm->isValid()) {
            $em->persist($sellbreak);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('complete_message',"This date has been added!");
    		return $this->redirect($this->generateUrl('ot_admin_toursells', array('id' => $entity->getId())));
        }
    }

    /**
     * @Route("/Admin/TourItinerary/{id}", name="ot_admin_touritinerary")
     */
    public function tourItinerary($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository(Tour::class)->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find tour entity.');
        }

    	$tourForm = $this->createForm(TourItineraryType::class, $entity);
    	$tourForm->handleRequest($request);
    
    	if ($tourForm->isSubmitted() && $tourForm->isValid()) {
    		// filter $originalTags to contain tags no longer present
            foreach ($entity->getItinerary() as $day)
            {
                $day->setTour($entity);
                if (isset($originalItinerary))
                    foreach ($originalItinerary as $key => $toDel)
                    {
                        if ($toDel->getId() === $day->getId())
                        {
                            unset($originalItinerary[$key]);
                        }
                    }
            }

            // remove the relationship between the tag and the Task
            if (isset($originalItinerary))
                foreach ($originalItinerary as $day)
                {
                    // remove the Task from the Tag
                    //$passenger->getTasks()->removeElement($entity);
                    // if it were a ManyToOne relationship, remove the relationship like this
                    //$tag->setTask(null);

                    $em->persist($day);

                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($day);
                }
    		
    		$em->persist($entity);
    		$em->flush();
    
    		$this->get('session')->getFlashBag()->add('complete_message',"This tour has been updated!");
    		return $this->redirect($this->generateUrl('ot_admin_touritinerary', array('id' => $entity->getId())));
    
    	}
    
    	return $this->render('touritinerary.html.twig', [
            'tourform' => $tourForm->createView(),
            'tour' => $entity,
        ]);
    }

    /**
     * @Route("/Admin/TourFeatures/{id}", name="ot_admin_tourfeatures")
     */
    public function tourFeatures($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository(Tour::class)->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find tour entity.');
        }

    	$tourForm = $this->createForm(TourFeaturesType::class, $entity);
    	$tourForm->handleRequest($request);
    
    	if ($tourForm->isSubmitted() && $tourForm->isValid()) {
    		// filter $originalTags to contain tags no longer present
            foreach ($entity->getFeatures() as $feature)
            {
                $feature->setTour($entity);
                if (isset($originalFeatures))
                    foreach ($originalFeatures as $key => $toDel)
                    {
                        if ($toDel->getId() === $feature->getId())
                        {
                            unset($originalFeatures[$key]);
                        }
                    }
            }

            // remove the relationship between the tag and the Task
            if (isset($originalFeatures))
                foreach ($originalFeatures as $feature)
                {
                    // remove the Task from the Tag
                    //$passenger->getTasks()->removeElement($entity);
                    // if it were a ManyToOne relationship, remove the relationship like this
                    //$tag->setTask(null);

                    $em->persist($feature);

                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($feature);
                }
    		
    		$em->persist($entity);
    		$em->flush();
    
    		$this->get('session')->getFlashBag()->add('complete_message',"This tour has been updated!");
    		return $this->redirect($this->generateUrl('ot_admin_tourfeatures', array('id' => $entity->getId())));
    
    	}
    
    	return $this->render('tourfeatures.html.twig', [
            'tourform' => $tourForm->createView(),
            'tour' => $entity,
        ]);
    }
}