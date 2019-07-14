<?php declare(strict_types=1);

namespace App\Adapter;

interface DataManagerInterface
{
    /**
     * get all the data and return an iterator
     *
     * @return array
     */
    public function getAll(): array;
}