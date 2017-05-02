<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Certification;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Certification controller.
 *
 * @Route("/admin/certifications")
 */
class CertificationController extends Controller
{
    /**
     * Lists all certification entities.
     *
     * @Route("/", name="certification_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $certifications = $em->getRepository('AppBundle:Certification')->findAll();

        return $this->render('AppBundle:Certification:index.html.twig', array(
            'certifications' => $certifications,
        ));
    }

    /**
     * Creates a new certification entity.
     *
     * @Route("/new", name="certification_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $certification = new Certification();
        $form = $this->createForm('AppBundle\Form\CertificationType', $certification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($certification);
            $em->flush($certification);

            return $this->redirectToRoute('certification_show', array('id' => $certification->getId()));
        }

        return $this->render('AppBundle:Certification:new.html.twig', array(
            'certification' => $certification,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a certification entity.
     *
     * @Route("/{id}", name="certification_show")
     * @Method("GET")
     */
    public function showAction(Certification $certification)
    {
        $deleteForm = $this->createDeleteForm($certification);

        return $this->render('AppBundle:Certification:show.html.twig', array(
            'certification' => $certification,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing certification entity.
     *
     * @Route("/{id}/edit", name="certification_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Certification $certification)
    {
        $deleteForm = $this->createDeleteForm($certification);
        $editForm = $this->createForm('AppBundle\Form\CertificationType', $certification);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('certification_edit', array('id' => $certification->getId()));
        }

        return $this->render('AppBundle:Certification:edit.html.twig', array(
            'certification' => $certification,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a certification entity.
     *
     * @Route("/{id}", name="certification_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Certification $certification)
    {
        $form = $this->createDeleteForm($certification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($certification);
            $em->flush($certification);
        }

        return $this->redirectToRoute('certification_index');
    }

    /**
     * Creates a form to delete a certification entity.
     *
     * @param Certification $certification The certification entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Certification $certification)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('certification_delete', array('id' => $certification->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
