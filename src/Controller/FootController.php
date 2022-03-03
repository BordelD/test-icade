<?php

namespace App\Controller;

use App\Client\FootballClient;
use App\Model\Response;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FootController extends AbstractController
{
    #[Route('/list', name: 'foot_list')]
    public function list(FootballClient $client, SerializerInterface $serializer)
    {
        $frenchLeagueId = 61;
        $season = 2021;

        //$data = $client->getFixture($frenchLeagueId, $season);
        $data = $serializer->deserialize(file_get_contents('test.json'), Response::class, 'json');

        return $this->render('foot/home.html.twig', [
            'data' => $data->response
        ]);
    }
}
