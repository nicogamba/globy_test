<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $starWarsApiService;

    public function __construct(StarWarsApiService $starWarsApiService)
    {
        $this->starWarsApiService = $starWarsApiService;
    }

    #[Route("/api/people", name: "api_people", methods: ["POST"])]
    public function getPeople(Request $request): JsonResponse
    {
        $page = $request->request->get('page', 1);
        $data = $this->starWarsApiService->fetchPeople($page);

        return new JsonResponse($data);
    }
}
