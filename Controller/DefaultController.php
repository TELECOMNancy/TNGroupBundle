<?php

namespace Videl\TNGroupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$session = new Session();

    	$groups = $this->get('security.context')->getToken()->getUser()->getGroups();
    	foreach($groups as $group)
    	{
    		$session->set('default_club', $group);
    	}

        return $this->render('TNGroupBundle:Default:index.html.twig');
    }

    public function switchClubAction()
    {

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
        $form = $this->createForm(new ClubSwitcherType(), $entity, array(
            'action' => $this->generateUrl('tn_group_club_switcher'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
}
