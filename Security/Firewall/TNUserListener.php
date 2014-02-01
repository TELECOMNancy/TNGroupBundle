<?php
namespace Videl\TNGroupBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Videl\TNGroupBundle\Security\Authentication\Token\TNUserToken;
use Symfony\Bridge\Monolog\Logger;

class TNUserListener implements ListenerInterface
{
    protected $securityContext;
    protected $authenticationManager;
    protected $logger;

    public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager, Logger $logger)
    {
        $this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;
        $this->logger = $logger;
    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        // $wsseRegex = '/UsernameToken Username="([^"]+)", PasswordDigest="([^"]+)", Nonce="([^"]+)", Created="([^"]+)"/';
        // if (!$request->headers->has('x-wsse') || 1 !== preg_match($wsseRegex, $request->headers->get('x-wsse'), $matches)) {
        //     return;
        // }
        // 
        $this->logger->info("Méthode : " . $request->getMethod());

        $token = new TNUserToken();
        $token->setUser("tn.net");

        $token->email = $request->get("_username");

        try {
            $authToken = $this->authenticationManager->authenticate($token);
            $this->securityContext->setToken($authToken);

            return;
        } catch (AuthenticationException $failed) {
            // ... you might log something here
            $this->logger->info("ERREUR: L'auth a echoué!");

            // To deny the authentication clear the token. This will redirect to the login page.
            // Make sure to only clear your token, not those of other authentication listeners.
            $token = $this->securityContext->getToken();
            if ($token instanceof TNUserToken /*&& $this->providerKey === $token->getProviderKey()*/) {
                $this->securityContext->setToken(null);
            }
            return;

            // Deny authentication with a '403 Forbidden' HTTP response
            $response = new Response();
            $response->setStatusCode(Response::HTTP_FORBIDDEN);
            $event->setResponse($response);

        }

        // By default deny authorization
        $response = new Response();
        $response->setStatusCode(Response::HTTP_FORBIDDEN);
        $event->setResponse($response);
    }
}