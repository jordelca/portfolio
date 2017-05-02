<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Education;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Education controller.
 *
 * @Route("/admin/education")
 */
class EducationController extends Controller
{
    /**
     * Lists all education entities.
     *
     * @Route("/", name="education_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $educations = $em->getRepository('AppBundle:Education')->findAll();

        return $this->render('AppBundle:Education:index.html.twig', array(
            'educations' => $educations,
        ));
    }

    /**
     * Creates a new education entity.
     *
     * @Route("/new", name="education_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $education = new Education();
        $form = $this->createForm('AppBundle\Form\EducationType', $education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($education);
            $em->flush($education);

            return $this->redirectToRoute('education_show', array('id' => $education->getId()));
        }

        return $this->render('AppBundle:Education:new.html.twig', array(
            'education' => $education,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a education entity.
     *
     * @Route("/{id}", name="education_show")
     * @Method("GET")
     */
    public function showAction(Education $education)
    {
        $deleteForm = $this->createDeleteForm($education);

        return $this->render('AppBundle:Education:show.html.twig', array(
            'education' => $education,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing education entity.
     *
     * @Route("/{id}/edit", name="education_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Education $education)
    {
        $deleteForm = $this->createDeleteForm($education);
        $editForm = $this->createForm('AppBundle\Form\EducationType', $education);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('education_edit', array('id' => $education->getId()));
        }

        return $this->render('AppBundle:Education:edit.html.twig', array(
            'education' => $education,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a education entity.
     *
     * @Route("/{id}", name="education_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Education $education)
    {
        $form = $this->createDeleteForm($education);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($education);
            $em->flush($education);
        }

        return $this->redirectToRoute('education_index');
    }

    /**
     * Creates a form to delete a education entity.
     *
     * @param Education $education The education entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Education $education)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('education_delete', array('id' => $education->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
