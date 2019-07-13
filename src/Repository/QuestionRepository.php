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


    public function getAll()
    {
        $iterator = $this->dataManager->getAll();
        $questions = [];
        
        foreach ($iterator as $data) {
            $question = new Question();
            $question->setQuestion($data['Question text']);
            $question->setQuestion($data['Created At']);
            $question->setQuestion([$data[''];
        }
    }

}