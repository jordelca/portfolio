<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends BaseController
{

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {

            // redirect authenticated users to homepage
            return $this->redirect($this->generateUrl('admin_homepage'));
        }

        $response = BaseController::loginAction($request);
        return $response;
    }

    /**
         * @Route("/user/profile", name="profile_show")
     */
    public function showAction(Request $request)
    {

    }

    /**
     * @Route("/user/edit", name="profile_edit")
     */
    public function editAction(Request $request)
    {

    }


    
}
