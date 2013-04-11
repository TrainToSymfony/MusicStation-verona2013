<?php

namespace MusicStation\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     *
     * cache expires in 1 hour
     * @Cache(expires="+1 hour", smaxage="3600")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        // get events sorting by ascendig start date
        $events = $em->getRepository('MusicStationUserBundle:Event')->findBy(
            array(),
            array('startDate' => 'ASC')
        );

        return array(
            'events' => $events
        );
    }

    /**
     * @Route("/about", name="about")
     * @Template()
     *
     * cache expires in 1 month
     * @Cache(expires="+1 month", smaxage="2592000")
     */
    public function aboutAction()
    {
        return array();
    }
}
