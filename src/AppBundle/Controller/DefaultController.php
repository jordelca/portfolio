<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }

    /**
     * @Route("/education", name="education")
     */
    public function educationAction(Request $request)
    {
        return $this->render('@App/Education/index.html.twig');
    }

    /**
     * @Route("/certifications", name="certifications")
     */
    public function certificationsAction(Request $request)
    {
        return $this->render('@App/Certifications/index.html.twig');
    }

    /**
     * @Route("/jobs", name="jobs")
     */
    public function jobsAction(Request $request)
    {
        return $this->render('@App/Jobs/index.html.twig');
    }

    /**
     * @Route("/projects", name="projects")
     */
    public function projectsAction(Request $request)
    {
        return $this->render('@App/Projects/index.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('@User/Contact/index.html.twig');
    }

    /**
     * @Route("/getpdf", name="getpdf")
     */
    public function getPdfAction()
    {
        return $this->render('@User/Default/index.html.twig');
    }
}
