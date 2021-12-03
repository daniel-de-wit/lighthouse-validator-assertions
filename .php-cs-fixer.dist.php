<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
    ->name('*.php')
;

$customRules = [];

return DanielDeWit\phpcsfixer($finder, $customRules);
