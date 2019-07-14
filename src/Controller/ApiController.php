<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\QuestionRepository;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    /**
     * @var QuestionRepository
     */
    protected $questionRepository;
    /**
     * @var CacheInterface
     */
    protected $cache;

    public function __construct(QuestionRepository $questionRepository, CacheInterface $cache)
    {
        $this->questionRepository = $questionRepository;
        $this->cache = $cache;
    }

    /**
     * get all the questions
     *
     * @Route("/questions/{lang}", methods={"GET"})
     * @param string $lang
     * @return JsonResponse
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getQuestions(string $lang): JsonResponse
    {
        try {
            $this->cache->set('lang', $lang);
            $response = $this->questionRepository->getAll();
            $code = 200;

        } catch (HttpException $e) {
            $code = $e->getStatusCode();
            $response = $e->getMessage();
        }
        return new JsonResponse($response, $code);
    }


    /**
     * add a new question
     *
     * @Route("/questions", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function createQuestion(Request $request): JsonResponse
    {
        try {
            $content = json_decode($request->getContent(), true);
            $question = [
                'question' => $content['text'],
                'createdAt' => $content['createdAt'],
                'choices' => $content['choices'][0],
            ];
            $response = $this->questionRepository->createOne($question);
            $code = 200;

        } catch (HttpException $e) {
            $code = $e->getStatusCode();
            $response = $e->getMessage();
        }
        return new JsonResponse($response, $code);
    }




}