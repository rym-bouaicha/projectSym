<?php

namespace App\Controller;

use App\Entity\Station;
use App\Form\StationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/station')]
class StationController extends AbstractController
{






    #[Route('/', name: 'app_station_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $stations = $entityManager
            ->getRepository(Station::class)
            ->findAll();

        return $this->render('station/index.html.twig', [
            'stations' => $stations,
        ]);
    }




    #[Route('/front', name: 'app_station_indexfront', methods: ['GET'])]
    public function indexfront(EntityManagerInterface $entityManager): Response
    {
        $stations = $entityManager
            ->getRepository(Station::class)
            ->findAll();

        return $this->render('station/indexfront.html.twig', [
            'stations' => $stations,
        ]);
    }


    #[Route('/front/{idStation}', name: 'app_station_showfront', methods: ['GET'])]
    public function showfront(Station $station): Response
    {
        return $this->render('station/showfront.html.twig', [
            'station' => $station,
        ]);
    }

    #[Route('/new', name: 'app_station_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $station = new Station();
        $form = $this->createForm(StationType::class, $station);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($station);
            $entityManager->flush();

            return $this->redirectToRoute('app_station_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('station/new.html.twig', [
            'station' => $station,
            'form' => $form,
        ]);
    }

    #[Route('/{idStation}', name: 'app_station_show', requirements: ['idStation' => '\d+'], methods: ['GET'])]
    public function show(int $idStation, EntityManagerInterface $entityManager): Response
    {
        $station = $entityManager->getRepository(Station::class)->find($idStation);

        return $this->render('station/show.html.twig', [
            'station' => $station,
        ]);
    }



    #[Route('/{idStation}/edit', name: 'app_station_edit', methods: ['GET', 'POST'])]
    public function edit(int $idStation, Request $request, EntityManagerInterface $entityManager): Response
    {
        $station = $entityManager->getRepository(Station::class)->find($idStation);
        $form = $this->createForm(StationType::class, $station);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_station_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('station/edit.html.twig', [
            'station' => $station,
            'form' => $form,
        ]);
    }

    #[Route('/{idStation}', name: 'app_station_delete', methods: ['POST'])]
    public function delete(int $idStation, Request $request, EntityManagerInterface $entityManager): Response
    {
        $station = $entityManager->getRepository(Station::class)->find($idStation);

        if (!$station) {
            throw $this->createNotFoundException('Station not found');
        }

        if ($this->isCsrfTokenValid('delete'.$station->getIdStation(), $request->request->get('_token'))) {
            $entityManager->remove($station);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_station_index', [], Response::HTTP_SEE_OTHER);
    }
}
