<?php

namespace App\Controller;

use App\Manager\FootballManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FootController extends AbstractController
{
    #[Route('/list', name: 'foot_list')]
    public function list(FootballManager $footballManager)
    {
        $frenchLeagueId = 61;
        $season = 2021;
        $fixtures  = $footballManager->getFixtures($frenchLeagueId, $season);

        return $this->render('foot/home.html.twig', [
            'fixtures' => $fixtures
        ]);
    }

    #[Route('/details/{fixtureId}', name: 'foot_details')]
    public function details(FootballManager $footballManager, $fixtureId)
    {
        return $this->render('components/fixture_details.html.twig', [
            'events' => $footballManager->getEvents($fixtureId),
        ]);
    }
}
