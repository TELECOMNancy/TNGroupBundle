<?php

namespace Videl\TNGroupBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClubSwitcherType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('group', 'entity',
                array(
                    'class' => 'TNGroupBundle:TNGroup'
                )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Videl\TNGroupBundle\Entity\TNGroup'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'videl_tngroupbundle_tngroup';
    }
}
