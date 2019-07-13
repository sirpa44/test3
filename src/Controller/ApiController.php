<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * get all the questions
     *
     * @Route("/questions", methods={"GET"})
     * @return JsonResponse
     */
    public function getQuestions(): JsonResponse
    {
        try {
            $this->questionRepository->getAll();

        } catch (HttpException $e) {
            $code = $e->getStatusCode();
            $response = $e->getMessage();
        }
        return new JsonResponse($response, $code);
    }


    /**
     * @Route("/questions", methods={"POST"})
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
//        try {
//
//        } catch () {
//
//        }
    }




}