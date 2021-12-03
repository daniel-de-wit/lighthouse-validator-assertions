<?php

declare(strict_types=1);

namespace DanielDeWit\LighthouseValidatorAssertions\Tests\Unit;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

abstract class UnitTest extends TestCase
{
    use MockeryPHPUnitIntegration;
}
