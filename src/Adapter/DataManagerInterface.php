<?php declare(strict_types=1);

namespace App\Adapter;

use App\Entity\Question;

interface DataManagerInterface
{
    /**
     * get all the data and return an iterator.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * add a new question to the data file.
     *
     * @param Question $question
     * @return mixed
     */
    public function addNew(Question $question);
}