<?php

namespace MusicStation\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ArtistController extends Controller
{
    /**
     * @Route("/artist", name="artist_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MusicStationUserBundle:Artist')->findBy(
            array(),
            array('name' => 'ASC')
        );

        return array(
            'entities' => $entities
        );
    }

    /**
     * @Route("/artist/{id}", name="artist_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MusicStationUserBundle:Artist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Artist entity.');
        }

        return array(
            'entity' => $entity
        );
    }
}
