<?php

namespace App\Helpers;

use App\Chart;
use App\Country;


class CountryHelper 
{
    public function __construct(Country $model)
    {
        $this->model = $model;
    }
    public function dropdown()
    {
        return $this->model->get();
    }

}
