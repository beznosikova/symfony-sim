<?php

namespace AppBundle\Controller;

use AppBundle\Form\FeedbackType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
//use AppBundle\Service\MessageGenerator;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    /*    public function indexAction()
        {
    //        $messageGenerator = $this->get('happy.message')->getHappyMessage();
    //        dump($messageGenerator);

            $name = "Tanya";
            // return $this->render('@App/default/index.html.twig', compact('name'));
            return compact('name');
        }
    */

    /**
     * @Route(
     *     "/{reactRouting}",
     *     name="homepage",
     *     requirements={"reactRouting"="^(?!admin|account|login_check|api).+"},
     *     defaults={"reactRouting": null}
     *     )
     */
    public function reactAction()
    {
        return $this->render('@App/default/react.html.twig');
    }

    /**
     * @Route("/feedback/", name="feedback")
     */
    public function feedBackAction(Request $request)
    {
        $form = $this->createForm(FeedbackType::class);
        $form->add('submit', SubmitType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $feedback = $form->getData();

            $em = $this->getDoctrine()->getManager(); // saving entity
            $em->persist($feedback);
            $em->flush();

            $this->addFlash('success', 'Saved');
            return $this->redirectToRoute('feedback');
        }

         return $this->render('@App/default/feed_back.html.twig', ['feedback_form' => $form->createView()]);
    }
}
