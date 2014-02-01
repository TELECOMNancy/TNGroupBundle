<?php
namespace Videl\TNGroupBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Http\Firewall\AbstractAuthenticationListener;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Videl\TNGroupBundle\Security\Authentication\Token\TNUserToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Monolog\Logger;

class TNUserListener extends AbstractAuthenticationListener
{
    protected $logger;

    // public function __construct(
    //     SecurityContextInterface $securityContext,
    //     AuthenticationManagerInterface $authenticationManager,
    //     SessionAuthenticationStrategyInterface $sessionStrategy,
    //     HttpUtils $httpUtils,
    //     $providerKey,
    //     AuthenticationSuccessHandlerInterface $successHandler,
    //     AuthenticationFailureHandlerInterface $failureHandler,
    //     array $options = array(),
    //     LoggerInterface $logger = null,
    //     EventDispatcherInterface $dispatcher = null
    // ) {
    //     parent::__construct(
    //         $securityContext,
    //         $authenticationManager,
    //         $sessionStrategy,
    //         $httpUtils,
    //         $providerKey,
    //         $successHandler,
    //         $failureHandler,
    //         array_merge(
    //             array(
    //                 'username_parameter' => '_username',
    //                 'password_parameter' => '_password',
    //                 'csrf_parameter'     => '_csrf_token',
    //                 'intention'          => 'authenticate',
    //                 'post_only'          => true,
    //             ),
    //             $options
    //         ),
    //         $logger,
    //         $dispatcher
    //     );

    // }

    public function attemptAuthentication(Request $request)
    {
        $this->logger->info("Abstract class : " . $request->getMethod());

        $token = new TNUserToken();

        if($request->getMethod() != "POST")
            return;

        $token->setUser("tnuser");

        $token->email = $request->get("_username") . '...';
    }
}