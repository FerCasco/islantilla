<?php

namespace App\Controller;
use App\Entity\Reserva;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\ReservaFormType;
class ReservaController extends AbstractController
{
    #[Route('/reserva', name: 'app_reserva')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservas = $entityManager->getRepository(Reserva::class)->findAll();

        return $this->render('reserva/index.html.twig', [
            'reservas' => $reservas,
        ]);
    }
    #[Route('/reserva/insertar', name: 'insertar_reserva')]
    public function insertarReserva(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservaFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reserva = $form->getData();

            $entityManager->persist($reserva);
            $entityManager->flush();

            return $this->redirectToRoute('insertar_reserva');
        }

        return $this->render('reserva/insertar.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
