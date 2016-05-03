<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TechSkill;
use AppBundle\Form\TechSkillType;

/**
 * TechSkill controller.
 *
 * @Route("/admin/techskill")
 */
class TechSkillController extends Controller
{
    /**
     * Lists all TechSkill entities.
     *
     * @Route("/", name="techskill_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $techSkills = $em->getRepository('AppBundle:TechSkill')->findAll();

        return $this->render('techskill/index.html.twig', array(
            'techSkills' => $techSkills,
        ));
    }

    /**
     * Creates a new TechSkill entity.
     *
     * @Route("/new", name="techskill_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $techSkill = new TechSkill();
        $form = $this->createForm('AppBundle\Form\TechSkillType', $techSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($techSkill);
            $em->flush();

            return $this->redirectToRoute('techskill_show', array('id' => $techSkill->getId()));
        }

        return $this->render('techskill/new.html.twig', array(
            'techSkill' => $techSkill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TechSkill entity.
     *
     * @Route("/{id}", name="techskill_show")
     * @Method("GET")
     */
    public function showAction(TechSkill $techSkill)
    {
        $deleteForm = $this->createDeleteForm($techSkill);

        return $this->render('techskill/show.html.twig', array(
            'techSkill' => $techSkill,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TechSkill entity.
     *
     * @Route("/{id}/edit", name="techskill_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TechSkill $techSkill)
    {
        $deleteForm = $this->createDeleteForm($techSkill);
        $editForm = $this->createForm('AppBundle\Form\TechSkillType', $techSkill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($techSkill);
            $em->flush();

            return $this->redirectToRoute('techskill_edit', array('id' => $techSkill->getId()));
        }

        return $this->render('techskill/edit.html.twig', array(
            'techSkill' => $techSkill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TechSkill entity.
     *
     * @Route("/{id}", name="techskill_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TechSkill $techSkill)
    {
        $form = $this->createDeleteForm($techSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($techSkill);
            $em->flush();
        }

        return $this->redirectToRoute('techskill_index');
    }

    /**
     * Creates a form to delete a TechSkill entity.
     *
     * @param TechSkill $techSkill The TechSkill entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TechSkill $techSkill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('techskill_delete', array('id' => $techSkill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
