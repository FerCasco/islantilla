<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\ClienteFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ClienteController extends AbstractController
{
    #[Route('/cliente', name: 'app_cliente')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $clientes = $entityManager->getRepository(Cliente::class)->findAll();

        $jsonClientes = [];
        foreach ($clientes as $cliente) {
            $jsonClientes[] = [
                'id' => $cliente->getId(),
                'nombre' => $cliente->getNombre(),
                'apellidos' => $cliente->getApellidos(),
                'telefono' => $cliente->getTelefono(),
            ];
        }

        return $this->render('cliente/index.html.twig', [
            'clientesJson' => json_encode($jsonClientes)
        ]);
    }
    #[Route('/cliente/insertar', name: 'insertar_cliente')]
    public function insertarCliente(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClienteFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cliente = $form->getData();

            $entityManager->persist($cliente);
            $entityManager->flush();

            return $this->redirectToRoute('insertar_cliente');
        }

        return $this->render('cliente/insertar.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
