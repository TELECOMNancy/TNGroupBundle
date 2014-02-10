<?php

namespace Videl\TNGroupBunde\Service;
use Symfony\Bundle\DoctrineBundle\Registry;



/**
* Use the article table.
*
* @author Videl
*/
class TNGUserGroups extends \Twig_Extension
{
    /**
* @var Symfony\Bundle\DoctrineBundle\Registry
*/
    protected $em;

    public function __construct(Registry $doctrine)
    {
        $this->em = $doctrine->getEntityManager();
    }

    public function getName()
    {
        return 'TNGUserGroups';
    }

    public function getFunctions()
    {
        return array(
            'user_groups' => new \Twig_Function_Method($this, 'userGroups'),
        );

        // 'antispam_check' est le nom de la fonction qui sera disponible sous Twig
        // 'new \Twig_Function_Method($this, 'isSpam') ' est la façon de dire que cette fonction va exécuter notre méthode isSpam ci-dessous
    }

    public function userGroups()
    {
        $repository = $this->em->getRepository('TNGroupBundle:User');

        return $repository->myLastArticle();
    }

    public function fakeArticle($text)
    {
        return $text;
    }

    public function getFilters()
    {
        return array(
            'shortify' => new \Twig_Filter_Method($this, 'lemmeShortify'),
        );
    }

    public function lemmeShortify($string, $limit = 15)
    {
        $words = explode(' ', strip_tags($string), $limit+1);
        $short = "";

        for($i=0;$i< $limit; $i++)
        {
            $short .= ' ' . $words[$i];
        }
        $short .= '...';

        return trim($short);
    }


}