<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return new RedirectResponse($this->generateUrl('homepage'));
    }
}
