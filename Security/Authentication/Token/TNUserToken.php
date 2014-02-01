<?php

namespace Videl\TNGroupBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class TNUserToken extends AbstractToken
{
    public $email;

    public function __construct(array $roles = array())
    {
        parent::__construct($roles);

        // If the user has roles, consider it authenticated
        $this->setAuthenticated(count($roles) > 0);
    }

    public function getCredentials()
    {
        return '';
    }

    public function serialize() {        
        $pser = parent::serialize();        
        return serialize(array($this->email, $pser));
    }

    public function unserialize($serialized) {
        list($this->email, $pser) = unserialize($serialized);        
        parent::unserialize($pser);        
    }
}