<?php declare(strict_types=1);

namespace App\Repository;

use App\Adapter\DataManagerInterface;
use App\Entity\Question;

class QuestionRepository
{

    /**
     * @var DataManagerInterface
     */
    protected $dataManager;

    public function __construct(DataManagerInterface $dataManager)
    {
        $this->dataManager = $dataManager;
    }


    /**
     * create an array of Question entity
     *
     * @return array
     */
    public function getAll(): array
    {
        $questionsArray = $this->dataManager->getAll();
        $questionEntityArray = [];
        foreach ($questionsArray as $data) {
            $question = new Question();
            $question->setQuestion($data['question']);
            $question->setCreationDate($data['createdAt']);
            $question->setChoices($data['choices']);
            $questionEntityArray[] = $question;
        }
        return $questionEntityArray;
    }

    /**
     * Create a new Question Entity and add it to the data file.
     *
     * @param array $question
     * @return Question
     */
    public function createOne(array $question): Question
    {
        $questionEntity = new Question();
        $questionEntity->setQuestion($question['question']);
        $questionEntity->setCreationDate($question['createdAt']);
        $questionEntity->setChoices($question['choices']);
        $this->dataManager->addNew($questionEntity);
        return $questionEntity;
    }

}