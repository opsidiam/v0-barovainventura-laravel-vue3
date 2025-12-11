<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundHandler
{
    public function __invoke(NotFoundHttpException $exception)
    {
        return redirect()->route('dashboard::index');
    }
}
