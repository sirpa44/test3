<?php declare(strict_types=1);

namespace App\Adapter;

use App\Entity\Question;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JsonManager implements DataManagerInterface
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * get al the question from Json file and return an array
     *
     * @return array
     */
    public function getAll(): array
    {
        if (!file_exists($this->path)) {
            throw new NotFoundHttpException();
        }
        $content = file_get_contents($this->path);
        $parsedData = json_decode($content, true);
        $questionsArray = $this->QuestionsArray($parsedData);
        return $questionsArray;
    }

    /**
     * create an array
     *
     * @param array $parsedData
     * @return array
     */
    protected function QuestionsArray(array $parsedData): array
    {
        $questionsArray = [];
        foreach ($parsedData as $question) {
            $questionArray['question'] = $question['text'];
            $questionArray['createdAt'] = $question['createdAt'];
            $choices =[];
            foreach ($question['choices'] as $choice) {
                $choices[] = $choice['text'];
            }
            $questionArray['choices'] = $choices;
            $questionsArray[] = $questionArray;
        }
        return $questionsArray;
    }

    /**
     * add a new question to the Csv file.
     *
     * @param Question $question
     * @return mixed
     * @throws \HttpException
     */
    public function addNew(Question $question)
    {
        throw new \HttpException('Method doesn\'t exist', 500);
    }
}