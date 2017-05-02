<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EducationCenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Educationcenter controller.
 *
 * @Route("/admin/educationcenters")
 */
class EducationCenterController extends Controller
{
    /**
     * Lists all educationCenter entities.
     *
     * @Route("/", name="educationcenter_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $educationCenters = $em->getRepository('AppBundle:EducationCenter')->findAll();

        return $this->render('AppBundle:EducationCenter:index.html.twig', array(
            'educationCenters' => $educationCenters,
        ));
    }

    /**
     * Creates a new educationCenter entity.
     *
     * @Route("/new", name="educationcenter_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $educationCenter = new Educationcenter();
        $form = $this->createForm('AppBundle\Form\EducationCenterType', $educationCenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($educationCenter);
            $em->flush($educationCenter);

            return $this->redirectToRoute('educationcenter_show', array('id' => $educationCenter->getId()));
        }

        return $this->render('AppBundle:EducationCenter:new.html.twig', array(
            'educationCenter' => $educationCenter,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a educationCenter entity.
     *
     * @Route("/{id}", name="educationcenter_show")
     * @Method("GET")
     */
    public function showAction(EducationCenter $educationCenter)
    {
        $deleteForm = $this->createDeleteForm($educationCenter);

        return $this->render('AppBundle:EducationCenter:show.html.twig', array(
            'educationCenter' => $educationCenter,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing educationCenter entity.
     *
     * @Route("/{id}/edit", name="educationcenter_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EducationCenter $educationCenter)
    {
        $deleteForm = $this->createDeleteForm($educationCenter);
        $editForm = $this->createForm('AppBundle\Form\EducationCenterType', $educationCenter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('educationcenter_edit', array('id' => $educationCenter->getId()));
        }

        return $this->render('AppBundle:EducationCenter:edit.html.twig', array(
            'educationCenter' => $educationCenter,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a educationCenter entity.
     *
     * @Route("/{id}", name="educationcenter_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EducationCenter $educationCenter)
    {
        $form = $this->createDeleteForm($educationCenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($educationCenter);
            $em->flush($educationCenter);
        }

        return $this->redirectToRoute('educationcenter_index');
    }

    /**
     * Creates a form to delete a educationCenter entity.
     *
     * @param EducationCenter $educationCenter The educationCenter entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EducationCenter $educationCenter)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('educationcenter_delete', array('id' => $educationCenter->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
