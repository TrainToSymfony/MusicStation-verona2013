<?php

namespace MusicStation\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use MusicStation\SiteBundle\Form\FeedbackType;

class FeedbackController extends Controller
{
    /**
     * Display the form to submit feedback
     *
     * @Route("/feedback", name="feedback")
     * @Template()
     *
     * cache expires in 1 month
     * @Cache(expires="+1 month", smaxage="2592000")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new FeedbackType());

        // manage user submitted data
        if ($request->getMethod() === 'POST') {
            $form->bind($request);

            // validate the form
            if ($form->isValid()) {

                // send feedback email
                $mailer = $this->container->get('musicstation.email_sender');
                $mailer->sendFeedbackEmail($form);

                $this->get('session')->getFlashBag()->add('show_feedback_confirm', true);

                return $this->redirect($this->generateUrl('feedback_confirm'));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * Display a confirmation page
     *
     * @Route("/feedback/thanks", name="feedback_confirm")
     * @Template()
     */
    public function confirmAction()
    {
        if ($this->get('session')->getFlashBag()->get('show_feedback_confirm')) {
            return array();
        }

        return $this->redirect($this->generateUrl('feedback'));
    }
}
