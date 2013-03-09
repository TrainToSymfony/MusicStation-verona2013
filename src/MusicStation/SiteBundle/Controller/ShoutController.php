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
    public function _aside_latestsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MusicStationUserBundle:Shout')->findBy(
            array(),
            array('id' => 'DESC')
        );

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

        return array(
            'entity' => $entity
        );
    }
}
