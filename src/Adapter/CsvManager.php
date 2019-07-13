<?php declare(strict_types=1);

namespace App\Adapter;


use League\Csv\Reader;

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
     * @return \Iterator
     */
    public function getAll():\Iterator
    {
        $csv = Reader::createFromPath($this->path, 'r');
        $csv->setHeaderOffset(0);
        $content = $csv->getIterator();
        return $content;
    }

}