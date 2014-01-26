<?php

namespace Videl\TNGroupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Videl\TNGroupBundle\Entity\Parameter;
use Videl\TNGroupBundle\Form\ParameterType;

/**
 * Parameter controller.
 *
 */
class ParameterController extends Controller
{

    /**
     * Lists all Parameter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TNGroupBundle:Parameter')->findAll();

        return $this->render('TNGroupBundle:Parameter:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Parameter entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Parameter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('parameter_show', array('id' => $entity->getId())));
        }

        return $this->render('TNGroupBundle:Parameter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Parameter entity.
    *
    * @param Parameter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Parameter $entity)
    {
        $form = $this->createForm(new ParameterType(), $entity, array(
            'action' => $this->generateUrl('parameter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Parameter entity.
     *
     */
    public function newAction()
    {
        $entity = new Parameter();
        $form   = $this->createCreateForm($entity);

        return $this->render('TNGroupBundle:Parameter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Parameter entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TNGroupBundle:Parameter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parameter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TNGroupBundle:Parameter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Parameter entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TNGroupBundle:Parameter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parameter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TNGroupBundle:Parameter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Parameter entity.
    *
    * @param Parameter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Parameter $entity)
    {
        $form = $this->createForm(new ParameterType(), $entity, array(
            'action' => $this->generateUrl('parameter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Parameter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TNGroupBundle:Parameter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parameter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('parameter_edit', array('id' => $id)));
        }

        return $this->render('TNGroupBundle:Parameter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Parameter entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TNGroupBundle:Parameter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Parameter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('parameter'));
    }

    /**
     * Creates a form to delete a Parameter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parameter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
