<?php
namespace Videl\TNGroupBundle\DependencyInjection\Security\Factory;
 
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\AbstractFactory;
 
class TNUserFactory extends AbstractFactory
{
 
/**
* {@inheritdoc}
*/
protected function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
{
$provider = 'security.authentication.provider.tnuser.'.$id;
$container
->setDefinition($provider, new DefinitionDecorator('security.authentication.provider.tnuser'))
->replaceArgument(0, new Reference($userProviderId))
;
 
return $provider;
}
 
 
/**
* {@inheritdoc}
*/
protected function createListener($container, $id, $config, $userProvider)
{
$listenerId = $this->getListenerId();
$listener = new DefinitionDecorator($listenerId);
$listener->replaceArgument(4, $id);
$listener->replaceArgument(5, new Reference($this->createAuthenticationSuccessHandler($container, $id, $config)));
$listener->replaceArgument(6, new Reference($this->createAuthenticationFailureHandler($container, $id, $config)));
$listener->replaceArgument(7, array_intersect_key($config, $this->options));
 
$listenerId .= '.'.$id;
$container->setDefinition($listenerId, $listener);
 
return $listenerId;
}
 
 
/**
* {@inheritdoc}
*/
protected function getListenerId()
{
return 'security.authentication.listener.tnuser';
}
 
 
/**
* {@inheritdoc}
*/
protected function isRememberMeAware($config)
{
return false;
}
public function getPosition()
{
return 'form';
}
public function getKey()
{
return 'tnuser';
}


}