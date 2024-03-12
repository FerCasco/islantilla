<?php

namespace App\Controller;

use App\Entity\Reserva;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ConsultasController extends AbstractController
{
    #[Route('/consultas', name: 'consultas')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Consulta 1: Todas las reservas con detalles de cliente, habitación y gasto total del cliente
        $reservasConDetalles = $entityManager->getRepository(Reserva::class)->createQueryBuilder('r')
            ->select('r.id AS reserva_id', 'c.nombre AS cliente_nombre', 'h.precio AS habitacion_precio', 'r.noches', '(h.precio * r.noches) AS gasto_total')
            ->leftJoin('r.cliente', 'c')
            ->leftJoin('r.habitacion', 'h')
            ->getQuery()
            ->getResult();

        // Consulta 2: Clientes con reservas para 1 semana o mas
        $nochesMinimas = 7;
        $reservasConNoches = $entityManager->getRepository(Reserva::class)->createQueryBuilder('r')
            ->select('c.nombre AS cliente_nombre','c.apellidos AS cliente_apellidos','r.id AS reserva_id','h.id AS habitacion_id','h.precio AS habitacion_precio', 'r.noches')
            ->leftJoin('r.cliente', 'c')
            ->leftJoin('r.habitacion', 'h')
            ->where('r.noches >= :noches')
            ->setParameter('noches', $nochesMinimas)
            ->getQuery()
            ->getResult();

        return $this->render('consultas/index.html.twig', [
            'reservasConDetalles' => $reservasConDetalles,
            'reservasConNoches' => $reservasConNoches,
        ]);
    }
}
