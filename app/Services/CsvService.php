<?php 

namespace App\Services;

use App\Contracts\Csv;
use League\Csv\Reader;

class CsvService implements Csv
{   
    /**
     * The delimeter used for the Csv
     * @var string
     */
    private $delimeter;

    public function __construct($delimeter)
    {
        $this->delimeter = $delimeter;
    }   

    public function getRows(string $content, array $columns = array()): array
    {
        $reader = Reader::createFromString($content);

        $reader->setDelimiter($this->delimeter);

        return $reader->getRecords($columns);
    }
}