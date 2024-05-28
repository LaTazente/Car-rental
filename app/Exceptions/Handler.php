<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Liste des types d’exceptions qui ne sont pas signalés.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * Liste des entrées qui ne sont jamais flashées pour les exceptions de validation.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Enregistrez les rappels de gestion des exceptions pour l’application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
