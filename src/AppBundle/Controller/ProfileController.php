<?php

namespace AppBundle\Controller;

use UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("/admin/profile")
 */
class ProfileController extends Controller
{

    /**
     * Finds and displays a user entity.
     *
     * @Route("/", name="profile_show")
     * @Method("GET")
     */
    public function showAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('AppBundle:Profile:show.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/edit", name="profile_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $editForm = $this->createForm('AppBundle\Form\ProfileType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile_edit', array('id' => $user->getId()));
        }

        return $this->render('AppBundle:Profile:edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            ));
    }
}
