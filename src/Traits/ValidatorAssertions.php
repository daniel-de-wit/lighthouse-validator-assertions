<?php

declare(strict_types=1);

namespace DanielDeWit\LighthouseValidatorAssertions\Contracts;

use DanielDeWit\LighthouseValidatorAssertions\Assertions\AssertArrayContains;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Testing\TestCase;
use Nuwave\Lighthouse\Support\Contracts\ArgumentSetValidation;

/**
 * @mixin TestCase
 */
trait ValidatorAssertions
{
    protected function assertValidatorMessages(
        ArgumentSetValidation $validator,
        array $input,
        array $expected,
        string $msg = '',
    ): void {
        $validationFactory = $this->app->make(ValidationFactory::class);

        $errors = $validationFactory->make(
            $input,
            $validator->rules(),
            $validator->messages(),
            $validator->attributes(),
        )->errors()->toArray();

        AssertArrayContains::assertArrayContains(
            $expected,
            $errors,
            false,
            $msg,
        );
    }
}
