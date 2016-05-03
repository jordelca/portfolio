<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\PortfolioEntry;
use AppBundle\Form\PortfolioEntryType;

/**
 * PortfolioEntry controller.
 *
 * @Route("/admin/portfolioentry")
 */
class PortfolioEntryController extends Controller
{
    /**
     * Lists all PortfolioEntry entities.
     *
     * @Route("/", name="portfolioentry_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $portfolioEntries = $em->getRepository('AppBundle:PortfolioEntry')->findAll();

        return $this->render('portfolioentry/index.html.twig', array(
            'portfolioEntries' => $portfolioEntries,
        ));
    }

    /**
     * Creates a new PortfolioEntry entity.
     *
     * @Route("/new", name="portfolioentry_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $portfolioEntry = new PortfolioEntry();
        $form = $this->createForm('AppBundle\Form\PortfolioEntryType', $portfolioEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($portfolioEntry);
            $em->flush();

            return $this->redirectToRoute('portfolioentry_show', array('id' => $portfolioEntry->getId()));
        }

        return $this->render('portfolioentry/new.html.twig', array(
            'portfolioEntry' => $portfolioEntry,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PortfolioEntry entity.
     *
     * @Route("/{id}", name="portfolioentry_show")
     * @Method("GET")
     */
    public function showAction(PortfolioEntry $portfolioEntry)
    {
        $deleteForm = $this->createDeleteForm($portfolioEntry);

        return $this->render('portfolioentry/show.html.twig', array(
            'portfolioEntry' => $portfolioEntry,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PortfolioEntry entity.
     *
     * @Route("/{id}/edit", name="portfolioentry_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PortfolioEntry $portfolioEntry)
    {
        $deleteForm = $this->createDeleteForm($portfolioEntry);
        $editForm = $this->createForm('AppBundle\Form\PortfolioEntryType', $portfolioEntry);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($portfolioEntry);
            $em->flush();

            return $this->redirectToRoute('portfolioentry_edit', array('id' => $portfolioEntry->getId()));
        }

        return $this->render('portfolioentry/edit.html.twig', array(
            'portfolioEntry' => $portfolioEntry,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PortfolioEntry entity.
     *
     * @Route("/{id}", name="portfolioentry_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PortfolioEntry $portfolioEntry)
    {
        $form = $this->createDeleteForm($portfolioEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($portfolioEntry);
            $em->flush();
        }

        return $this->redirectToRoute('portfolioentry_index');
    }

    /**
     * Creates a form to delete a PortfolioEntry entity.
     *
     * @param PortfolioEntry $portfolioEntry The PortfolioEntry entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PortfolioEntry $portfolioEntry)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('portfolioentry_delete', array('id' => $portfolioEntry->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
