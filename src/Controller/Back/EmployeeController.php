<?php

namespace App\Controller\Back;

use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employee")
 */
class EmployeeController extends AbstractController
{
    /**
     * @Route("/", name="employee_index", methods="GET")
     */
    public function index(EmployeeRepository $employeeRepository): Response
    {
        return $this->render('Back/employee/index.html.twig', ['employees' => $employeeRepository->findAll(),
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route("/new", name="employee_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('employee_index');
        }

        return $this->render('Back/employee/new.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route("/{id}", name="employee_show", methods="GET")
     */
    public function show(Employee $employee): Response
    {
        return $this->render('Back/employee/show.html.twig', ['employee' => $employee,
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route("/{id}/edit", name="employee_edit", methods="GET|POST")
     */
    public function edit(Request $request, Employee $employee): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employee_edit', ['id' => $employee->getId()]);
        }

        return $this->render('Back/employee/edit.html.twig', [
            'employee' => $employee,
            'form' => $form->createView(),
            'bg' => "bg_carte",
        ]);
    }

    /**
     * @Route("/{id}", name="employee_delete", methods="DELETE")
     */
    public function delete(Request $request, Employee $employee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employee->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush();
        }

        return $this->redirectToRoute('employee_index');
    }
}
