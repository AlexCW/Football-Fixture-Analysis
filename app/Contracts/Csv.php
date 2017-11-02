<?php namespace App\Contracts;

interface Csv
{
    /**
     * Get the rows with the specified headers
     * @param  array  $columns
     * @return array         
     */
    public function getRows(array $columns = array());
}