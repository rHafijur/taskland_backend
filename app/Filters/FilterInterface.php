<?php

namespace App\Filters;

interface FilterInterface
{
    public function apply($query);
}
