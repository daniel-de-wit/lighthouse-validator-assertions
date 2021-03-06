<?php

namespace DanielDeWit\LighthouseValidatorAssertions\Assertions;

use DanielDeWit\LighthouseValidatorAssertions\Constraints\ArrayContainsConstraint;
use PHPUnit\Framework\Assert as PHPUnit;

abstract class AssertArrayContains
{
    /**
     * @param  array<string, array<mixed>>  $subset
     * @param  array<string, array<mixed>>  $array
     * @param  bool  $checkForIdentity
     * @param  string  $msg
     */
    public static function assertArrayContains(
        array $subset,
        array $array,
        bool $checkForIdentity = false,
        string $msg = '',
    ): void {
        PHPUnit::assertThat(
            $array,
            new ArrayContainsConstraint($subset, $checkForIdentity),
            $msg,
        );
    }
}
