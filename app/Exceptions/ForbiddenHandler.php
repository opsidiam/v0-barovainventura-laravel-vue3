<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ForbiddenHandler
{
    public function __invoke(HttpException $exception)
    {
        if ($exception->getStatusCode() === 403) {
            return redirect()->route('dashboard::index');
        }
    }
}
