<?php


declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class TemplateDataMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly TemplateEngine $view)
    {

    }
    public function process(callable $next): void
    {
        $this->view->addGlobal('title', 'Expense Tracking App');

        $next();
    }
}