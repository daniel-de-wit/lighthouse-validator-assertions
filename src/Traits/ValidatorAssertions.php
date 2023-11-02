<?php

declare(strict_types=1);

namespace DanielDeWit\LighthouseValidatorAssertions\Traits;

use DanielDeWit\LighthouseValidatorAssertions\Assertions\AssertArrayContains;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Nuwave\Lighthouse\Support\Contracts\ArgumentSetValidation;

trait ValidatorAssertions
{
    protected function assertValidatorMessages(
        FormRequest $request,
        array $input,
        array $expected,
        string $msg = '',
    ): void {
        $validationFactory = $this->getApplication()->make(ValidationFactory::class);

        $errors = $validationFactory->make(
            $input,
            $request->rules(),
            $request->messages(),
            $request->attributes(),
        )->errors()->toArray();

        AssertArrayContains::assertArrayContains(
            $expected,
            $errors,
            false,
            $msg,
        );
    }

    abstract protected function getApplication(): Application;
}
