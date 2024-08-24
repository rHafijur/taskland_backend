<?php

namespace App\Filters;

use App\Filters\FilterInterface;

class CreatedByFilter implements FilterInterface
{
    public function __construct(private $createdBy)
    {
    }

    public function apply($query)
    {
        return $query->where('created_by', $this->createdBy);
    }
}
