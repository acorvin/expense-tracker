<?php

declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

function dd(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo"</pre>";
    die();
}

// Prevent malicious code injection
function sanitize(mixed $value): string {
    return htmlspecialchars((string) $value);
}

function redirectTo(string $path) {
    header("Location: {$path}");
    http_response_code(302);
    exit;
}