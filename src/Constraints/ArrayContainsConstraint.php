<?php

namespace DanielDeWit\LighthouseValidatorAssertions\Constraints;

use PHPUnit\Framework\Constraint\Constraint;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Exporter\Exporter;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

/**
 * Copied from https://github.com/sebastianbergmann/phpunit/pull/3161
 *
 * Constraint that asserts that the array it is evaluated for has a specified subset.
 *
 * Uses array_replace_recursive() to check if a key value subset is part of the
 * subject array.
 */
class ArrayContainsConstraint extends Constraint
{
    /**
     * @param  array<string, array<mixed>>  $subset
     * @param  bool  $strict
     */
    public function __construct(
        protected array $subset,
        protected bool $strict = false,
    ) {
    }

    /**
     * Evaluates the constraint for parameter $other
     *
     * If $returnResult is set to false (the default), an exception is thrown
     * in case of a failure. null is returned otherwise.
     *
     * If $returnResult is true, the result of the evaluation is returned as
     * a boolean value instead: true in case of success, false in case of a
     * failure.
     *
     * @param  array  $other  value or object to evaluate
     * @param  string  $description  Additional information about the test
     * @param  bool  $returnResult  Whether to return a result or throw an exception
     *
     * @return bool|null
     */
    public function evaluate($other, string $description = '', bool $returnResult = false): ?bool
    {
        $intersect = $this->arrayIntersectRecursive($other, $this->subset);
        $this->deepSort($intersect);
        $this->deepSort($this->subset);

        $result = $this->compare($intersect, $this->subset);

        if ($returnResult) {
            return $result;
        }

        if (! $result) {
            $f = new ComparisonFailure(
                $this->subset,
                $other,
                var_export($this->subset, true),
                var_export($other, true),
                false,
            );

            $this->fail($other, $description, $f);
        }

        return null;
    }

    /**
     * Returns a string representation of the constraint.
     *
     * @throws InvalidArgumentException
     */
    public function toString(): string
    {
        return 'contain ' . (new Exporter)->export($this->subset);
    }

    /**
     * Returns the description of the failure
     *
     * The beginning of failure messages is "Failed asserting that" in most
     * cases. This method should return the second part of that sentence.
     *
     * @param  mixed  $other  evaluated value or object
     *
     * @throws InvalidArgumentException
     */
    protected function failureDescription($other): string
    {
        return 'the validation messages ' . $this->toString();
    }

    protected function isAssociative(array $array): bool
    {
        return \array_reduce(\array_keys($array), function (bool $carry, $key): bool {
            return $carry || \is_string($key);
        }, false);
    }

    protected function compare($first, $second): bool
    {
        return $this->strict ? $first === $second : $first == $second;
    }

    protected function deepSort(array &$array): void
    {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $this->deepSort($value);
            }
        }

        if ($this->isAssociative($array)) {
            ksort($array);
        } else {
            sort($array);
        }
    }

    protected function arrayIntersectRecursive(array $array, array $subset): array
    {
        $intersect = [];

        if ($this->isAssociative($subset)) {
            // If the subset is an associative array, get the intersection while
            // preserving the keys.
            foreach ($subset as $key => $subset_value) {
                if (array_key_exists($key, $array)) {
                    $array_value = $array[$key];

                    if (is_array($subset_value) && is_array($array_value)) {
                        $intersect[$key] = $this->arrayIntersectRecursive($array_value, $subset_value);
                    } elseif ($this->compare($subset_value, $array_value)) {
                        $intersect[$key] = $array_value;
                    }
                }
            }
        } else {
            // If the subset is an indexed array, loop over all entries in the
            // haystack and check if they match the ones in the subset.
            foreach ($array as $array_value) {
                if (is_array($array_value)) {
                    foreach ($subset as $key => $subset_value) {
                        if (is_array($subset_value)) {
                            $recursed = $this->arrayIntersectRecursive($array_value, $subset_value);

                            if (! empty($recursed)) {
                                $intersect[$key] = $recursed;

                                break;
                            }
                        }
                    }
                } else {
                    foreach ($subset as $key => $subset_value) {
                        if (! is_array($subset_value) && $this->compare(
                                $subset_value,
                                $array_value
                            )) {
                            $intersect[$key] = $array_value;

                            break;
                        }
                    }
                }
            }
        }

        return $intersect;
    }
}
