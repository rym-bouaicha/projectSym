<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Station;
use App\Repository\StationRepository;

class MapController extends AbstractController
{
    #[Route('/map', name: 'app_map')]
    public function index(): Response
    {
        $location = $this->getDoctrine()
            ->getRepository(Station::class)
            ->findOneBy([]);

        $longitude = $location->getLongitude();
        $latitude = $location->getLatitude();

        return $this->render('map/index.html.twig', [
            'mapbox_access_token' => 'pk.eyJ1IjoicnltYm91YWljaGEiLCJhIjoiY2xncnV6d3RuMTQxNjNobXIzMnF5a284NyJ9.m0q3S2My7FPWyaC6NRKU6g',
            'longitude' => $longitude,
            'latitude' => $latitude,
        ]);
    }


}
