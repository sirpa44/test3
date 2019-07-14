<?php declare(strict_types=1);

namespace App\Adapter;

class JsonManager implements DataManagerInterface
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getAll(): array
    {
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

}