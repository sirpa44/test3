<?php declare(strict_types=1);

namespace App\Adapter;


use App\Entity\Question;
use League\Csv\Reader;
use League\Csv\Writer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CsvManager implements DataManagerInterface
{
    /**
     * @var string
     */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * get all users as Iterator
     *
     * @return array
     */
    public function getAll(): array
    {
        if (!file_exists($this->path)) {
            throw new NotFoundHttpException();
        }
        $csv = Reader::createFromPath($this->path, 'r');
        $csv->setHeaderOffset(0);
        $iterator = $csv->getIterator();
        $questions = $this->QuestionsArray($iterator);
        return $questions;
    }

    /**
     * create an array
     *
     * @param \Iterator $iterator
     * @return array
     */
    protected function QuestionsArray(\Iterator $iterator): array
    {
        $questionsArray = [];
        foreach ($iterator as $question) {
            $questionArray['question'] = $question['Question text'];
            $questionArray['createdAt'] = $question['Created At'];
            $questionArray['choices'] = [
                'choice 1' => $question['Choice 1'],
                'choice 2' => $question['Choice 2'],
                'choice 3' => $question['Choice 3']];
            $questionsArray[] = $questionArray;
        }
        return $questionsArray;
    }

    /**
     * add a new question to the Csv file.
     *
     * @param Question $questionEntity
     * @return mixed|void
     * @throws \League\Csv\CannotInsertRecord
     */
    public function addNew(Question $questionEntity)
    {
        $csv = Writer::createFromPath($this->path, 'a');
            $question = [
                $questionEntity->getQuestion(),
                $questionEntity->getCreationDate()
            ];
        foreach ($questionEntity->getChoices() as $choice) {
            $question[] = $choice;
        }
        $csv->insertOne($question);
    }
}