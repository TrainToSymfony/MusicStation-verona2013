<?php

namespace MusicStation\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        // get events sorting by ascendig start date
        $events = $em->getRepository('MusicStationUserBundle:Event')->findBy(
            array(),
            array('startDate' => 'ASC')
        );

        $shouts = $em->getRepository('MusicStationUserBundle:Shout')->findBy(
            array(),
            array('id' => 'DESC')
        );

        return array(
            'events' => $events,
            'shouts' => $shouts
        );
    }

    /**
     * @Route("/about", name="about")
     * @Template()
     */
    public function aboutAction()
    {
        return array();
    }
}
