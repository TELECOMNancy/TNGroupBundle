<?php

namespace Videl\TNGroupBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParameterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parameterName')
            ->add('type')
            ->add('value')
            ->add('action')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Videl\TNGroupBundle\Entity\Parameter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'videl_tngroupbundle_parameter';
    }
}
