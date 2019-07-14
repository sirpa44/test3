<?php declare(strict_types=1);

namespace App\Repository;

use App\Adapter\DataManagerInterface;
use App\Entity\Question;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class QuestionRepository
{

    /**
     * @var DataManagerInterface
     */
    protected $dataManager;
    protected $translate;

    public function __construct(DataManagerInterface $dataManager)
    {
        $this->dataManager = $dataManager;
    }


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

    public function createOne(array $question)
    {
        $questionEntity = new Question();
        $questionEntity->setQuestion($question['question']);
        $questionEntity->setCreationDate($question['createdAt']);
        $questionEntity->setChoices($question['choices']);
        $this->dataManager->addNew($questionEntity);
    }

}