<?php

namespace MusicStation\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ShoutController extends Controller
{
    /**
     * Print the latest shouts
     *
     * @Template()
     */
    public function _aside_latestsAction($limit = 3)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MusicStationUserBundle:Shout')->findAllWithLimit($limit);

        return array(
            'entities' => $entities
        );
    }

    /**
     * @Route("/shout/{id}", name="shout_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MusicStationUserBundle:Shout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Shout entity.');
        }

        $shoutPrev = $em->getRepository('MusicStationUserBundle:Shout')->getPrev($entity);
        $shoutNext = $em->getRepository('MusicStationUserBundle:Shout')->getNext($entity);

        return array(
            'entity' => $entity,
            'shout_prev' => $shoutPrev,
            'shout_next' => $shoutNext
        );
    }
}
