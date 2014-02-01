<?php
namespace Videl\TNGroupBundle\Security\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Videl\TNGroupBundle\Security\Authentication\Token\TNUserToken;
use Symfony\Bridge\Monolog\Logger;

class TNUserProvider implements AuthenticationProviderInterface
{
    private $userProvider;
    private $cacheDir;
    private $em;
    private $logger;

    public function __construct(UserProviderInterface $userProvider, $cacheDir, \Doctrine\ORM\EntityManager $em, Logger $logger)
    {
        $this->userProvider = $userProvider;
        $this->cacheDir     = $cacheDir;
        $this->em           = $em;
        $this->logger       = $logger;
    }

    public function authenticate(TokenInterface $token)
    {
        $this->logger->info("Trying to authenticate " . $token->email);
        $user = $this->em->getRepository('TNGroupBundle:User')
            ->findOneBy(
                array('email' => $token->email)
            );

        if ($user) {
            $authenticatedToken = new TNUserToken($user->getRoles());
            $authenticatedToken->setUser($user);

            $this->logger->info("Authentication approved for " . $user->getUsername());

            return $authenticatedToken;
        }

        throw new AuthenticationException('The TNUser authentication failed.');
    }

    public function supports(TokenInterface $token)
    {
        return $token instanceof TNUserToken;
    }
}
