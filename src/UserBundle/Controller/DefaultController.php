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
            return $this->redirect($this->generateUrl('homepage'));
        }

        $response = BaseController::loginAction($request);
        return $response;
    }


    /**
     * @Route("/education", name="education")
     */
    public function educationAction(Request $request)
    {
        return $this->render('@App/Default/index.html.twig');
    }

    /**
     * @Route("/jobs", name="jobs")
     */
    public function jobsAction(Request $request)
    {
        return $this->render('@App/Default/index.html.twig');
    }

    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function portfolioAction(Request $request)
    {
        return $this->render('@App/Default/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('@User/Default/contact.html.twig');
    }

    /**
     * @Route("/getpdf", name="getpdf")
     */
    public function getPdfAction()
    {
        return $this->render('@User/Default/contact.html.twig');
    }
}
