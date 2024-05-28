<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * Les URI qui doivent être accessibles lorsque le mode de maintenance est activé.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
