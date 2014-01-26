<?php

namespace Videl\TNGroupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Videl\TNGroupBundle\Entity\TNGroup;
use Videl\TNGroupBundle\Form\TNGroupType;

/**
 * TNGroup controller.
 *
 */
class TNGroupController extends Controller
{

    /**
     * Lists all TNGroup entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TNGroupBundle:TNGroup')->findAll();

        return $this->render('TNGroupBundle:TNGroup:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TNGroup entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TNGroup();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tngroup_show', array('id' => $entity->getId())));
        }

        return $this->render('TNGroupBundle:TNGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a TNGroup entity.
    *
    * @param TNGroup $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TNGroup $entity)
    {
        $form = $this->createForm(new TNGroupType(), $entity, array(
            'action' => $this->generateUrl('tngroup_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TNGroup entity.
     *
     */
    public function newAction()
    {
        $entity = new TNGroup();
        $form   = $this->createCreateForm($entity);

        return $this->render('TNGroupBundle:TNGroup:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TNGroup entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TNGroupBundle:TNGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TNGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TNGroupBundle:TNGroup:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing TNGroup entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TNGroupBundle:TNGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TNGroup entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TNGroupBundle:TNGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TNGroup entity.
    *
    * @param TNGroup $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TNGroup $entity)
    {
        $form = $this->createForm(new TNGroupType(), $entity, array(
            'action' => $this->generateUrl('tngroup_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TNGroup entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TNGroupBundle:TNGroup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TNGroup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tngroup_edit', array('id' => $id)));
        }

        return $this->render('TNGroupBundle:TNGroup:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TNGroup entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TNGroupBundle:TNGroup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TNGroup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tngroup'));
    }

    /**
     * Creates a form to delete a TNGroup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tngroup_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
