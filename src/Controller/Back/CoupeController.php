<?php

namespace App\Controller\Back;

use App\Entity\Coupe;
use App\Form\CoupeType;
use App\Repository\CoupeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coupe")
 */
class CoupeController extends AbstractController
{
    /**
     * @Route("/", name="coupe_index", methods="GET")
     */
    public function index(CoupeRepository $coupeRepository): Response
    {
        return $this->render('Back/coupe/index.html.twig', ['coupes' => $coupeRepository->findAll(),
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route("/new", name="coupe_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $coupe = new Coupe();
        $form = $this->createForm(CoupeType::class, $coupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coupe);
            $em->flush();

            return $this->redirectToRoute('coupe_index');
        }

        return $this->render('Back/coupe/new.html.twig', [
            'coupe' => $coupe,
            'form' => $form->createView(),
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route("/{id}", name="coupe_show", methods="GET")
     */
    public function show(Coupe $coupe): Response
    {
        return $this->render('Back/coupe/show.html.twig', ['coupe' => $coupe,
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route("/{id}/edit", name="coupe_edit", methods="GET|POST")
     */
    public function edit(Request $request, Coupe $coupe): Response
    {
        $form = $this->createForm(CoupeType::class, $coupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coupe_edit', ['id' => $coupe->getId()]);
        }

        return $this->render('Back/coupe/edit.html.twig', [
            'coupe' => $coupe,
            'form' => $form->createView(),
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route("/{id}", name="coupe_delete", methods="DELETE")
     */
    public function delete(Request $request, Coupe $coupe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coupe->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($coupe);
            $em->flush();
        }

        return $this->redirectToRoute('coupe_index');
    }
}
