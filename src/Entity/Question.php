<?php

namespace App\Entity;

class Question implements \JsonSerializable
{

    protected $creationDate;
    protected $question;
    protected $choices;

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question): void
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param mixed $choices
     */
    public function setChoices($choices): void
    {
        $this->choices = $choices;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'question' => $this->getQuestion(),
            'createdAt' => $this->getCreationDate(),
            'choices' => $this->getChoices(),
        ];
    }


}