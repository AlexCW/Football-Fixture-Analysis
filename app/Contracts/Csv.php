<?php namespace App\Contracts;

interface Csv
{
    /**
     * Get the rows with the specified headers
     * @param string $content
     * @param  array  $columns
     * @return array         
     */
    public function getRows(string $content, array $columns = array()): array;
}