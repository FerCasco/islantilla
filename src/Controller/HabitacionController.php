<?php

namespace App\Controller;

use App\Entity\Habitacion;
use App\Form\HabitacionFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class HabitacionController extends AbstractController
{
    #[Route('/habitacion', name: 'app_habitacion')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $habitaciones = $entityManager->getRepository(Habitacion::class)->findAll();

        return $this->render('habitacion/index.html.twig', [
            'habitaciones' => $habitaciones,
        ]);
    }

    #[Route('/habitacion/insertar', name: 'insertar_habitacion')]
    public function insertarHabitacion(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HabitacionFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $habitacion = $form->getData();

            $entityManager->persist($habitacion);
            $entityManager->flush();

            return $this->redirectToRoute('insertar_habitacion');
        }

        return $this->render('habitacion/insertar.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/habitacion/{id}/editar', name: 'editar_habitacion')]
    public function editarHabitacion(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $habitacion = $entityManager->getRepository(Habitacion::class)->find($id);
    
        $form = $this->createForm(HabitacionFormType::class, $habitacion);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_habitacion');
        }
    
        return $this->render('habitacion/editar.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/habitacion/{id}/eliminar', name: 'eliminar_habitacion')]
    public function eliminarHabitacion(int $id, EntityManagerInterface $entityManager): Response
    {
        $habitacion = $entityManager->getRepository(Habitacion::class)->find($id);

        $entityManager->remove($habitacion);
        $entityManager->flush();

        return $this->redirectToRoute('app_habitacion');
    }

    #[Route('/habitacion/consultar-habitaciones', name: 'consultar_habitaciones')]
    public function consultarHabitaciones(EntityManagerInterface $entityManager): JsonResponse
    {
        $habitaciones = $entityManager->getRepository(Habitacion::class)->findAll();

        $json = [];
        foreach ($habitaciones as $habitacion) {
            $json[] = [
                "id" => $habitacion->getId(),
                "precio" => $habitacion->getPrecio(),
                "estado" => $habitacion->getEstado(),
                "tipo" => $habitacion->getTipo(),
            ];
        }

        return new JsonResponse($json);
    }
}
