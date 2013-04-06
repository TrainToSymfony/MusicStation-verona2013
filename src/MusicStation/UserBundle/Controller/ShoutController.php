<?php

namespace MusicStation\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MusicStation\UserBundle\Entity\Shout;
use MusicStation\UserBundle\Form\ShoutType;

/**
 * Shout controller.
 *
 * @Route("/user/shout")
 */
class ShoutController extends Controller
{
    /**
     * Lists all Shout entities.
     *
     * @Route("/", name="user_shout")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->container->get('security.context')->getToken()->getUser();

        $entities = $em->getRepository('MusicStationUserBundle:Shout')->findBy(
            array('artist' => $user->getArtist()),
            array('id' => 'DESC')
        );

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Shout entity.
     *
     * @Route("/create", name="user_shout_create")
     * @Method("POST")
     * @Template("MusicStationUserBundle:Shout:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Shout();
        $form = $this->createForm(new ShoutType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // associate artist
            $user = $this->container->get('security.context')->getToken()->getUser();
            $entity->setArtist($user->getArtist());


            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_shout_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Shout entity.
     *
     * @Route("/new", name="user_shout_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Shout();
        $form   = $this->createForm(new ShoutType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Shout entity.
     *
     * @Route("/{id}/edit", name="user_shout_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MusicStationUserBundle:Shout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Shout entity.');
        }

        $editForm = $this->createForm(new ShoutType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Shout entity.
     *
     * @Route("/{id}/update", name="user_shout_update")
     * //@Method("PUT")
     * @Template("MusicStationUserBundle:Shout:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MusicStationUserBundle:Shout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Shout entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ShoutType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_shout_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Shout entity.
     *
     * @Route("/{id}/delete", name="user_shout_delete")
     * //@Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MusicStationUserBundle:Shout')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Shout entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user_shout'));
    }

    /**
     * Prints a form to delete a Shout entity by id.
     *
     * @Template()
     */
    public function _deleteFormAction($id)
    {
        return array(
            'delete_form' => $this->createDeleteForm($id)->createView()
        );
    }

    /**
     * Creates a form to delete a Shout entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
