<?php

namespace App\Filters;

use App\Filters\FilterInterface;

class UpcomingDeadlineFilter implements FilterInterface
{
    public function __construct(private $datetime)
    {
    }

    public function apply($query)
    {
        return $query->whereNull('completed_at')->where('due_date', '<', $this->datetime);
    }
}
