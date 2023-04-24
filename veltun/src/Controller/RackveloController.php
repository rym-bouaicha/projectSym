<?php

namespace App\Controller;

use App\Entity\Rackvelo;
use App\Form\RackveloType;
use App\Repository\RackveloRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rackvelo')]
class RackveloController extends AbstractController
{
    #[Route('/', name: 'app_rackvelo_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $rackvelos = $entityManager
            ->getRepository(Rackvelo::class)
            ->findAll();

        return $this->render('rackvelo/index.html.twig', [
            'rackvelos' => $rackvelos,
        ]);
    }

    #[Route('/new', name: 'app_rackvelo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rackvelo = new Rackvelo();
        $form = $this->createForm(RackveloType::class, $rackvelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rackvelo);
            $entityManager->flush();

            return $this->redirectToRoute('app_rackvelo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rackvelo/new.html.twig', [
            'rackvelo' => $rackvelo,
            'form' => $form,
        ]);
    }

    #[Route('/{refRack}', name: 'app_rackvelo_show', methods: ['GET'])]
    public function show(Rackvelo $rackvelo): Response
    {
        return $this->render('rackvelo/show.html.twig', [
            'rackvelo' => $rackvelo,
        ]);
    }

    #[Route('/{refRack}/edit', name: 'app_rackvelo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rackvelo $rackvelo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RackveloType::class, $rackvelo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rackvelo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rackvelo/edit.html.twig', [
            'rackvelo' => $rackvelo,
            'form' => $form,
        ]);
    }

    #[Route('/{refRack}', name: 'app_rackvelo_delete', methods: ['POST'])]
    public function delete(Request $request, Rackvelo $rackvelo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rackvelo->getRefRack(), $request->request->get('_token'))) {
            $entityManager->remove($rackvelo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_rackvelo_index', [], Response::HTTP_SEE_OTHER);
    }

    public function charts(RackVeloRepository $rackVeloRepository): Response
    {
        $racksByStation = $rackVeloRepository->getRacksByStation();
        $stationNames = [];
        $rackCounts = [];
        foreach ($racksByStation as $row) {
            $stationNames[] = $row['nomStation'];
            $rackCounts[] = $row['rackCount'];
        }

        // Create the chart data
        $chartData = [
            'labels' => $stationNames,
            'datasets' => [
                [
                    'label' => 'Number of racks',
                    'data' => $rackCounts,
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        // Add more colors if needed
                    ],
                ],
            ],
        ];



        return $this->render('station/charts.html.twig', [
            'racksByStation' => $racksByStation,
        ]);
    }
}
