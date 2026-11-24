<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php84\Rector\FuncCall\AddEscapeArgumentRector;
use Rector\Php84\Rector\Param\ExplicitNullableParamTypeRector;

/**
 * Only rules that fix real PHP 8.4 deprecations/breaking changes.
 */
return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withRules([
        ExplicitNullableParamTypeRector::class,
        AddEscapeArgumentRector::class,
    ]);
