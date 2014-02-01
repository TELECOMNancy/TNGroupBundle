<?php

namespace Videl\TNGroupBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Videl\TNGroupBundle\DependencyInjection\Security\Factory\TNUserFactory;

class TNGroupBundle extends Bundle
{
	public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new TNUserFactory());
    }
}
