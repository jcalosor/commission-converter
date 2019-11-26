<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Tests;

use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class AbstractTestCase extends TestCase
{
    /**
     * Create mock for given class and set expectations using given closure.
     *
     * @param mixed $class
     * @param \Closure|null $setExpectations
     *
     * @return \Mockery\MockInterface
     */
    protected function mock($class, \Closure $setExpectations = null): MockInterface
    {
        $mock = \Mockery::mock($class);

        if (\is_string($class) === false) {
            return $mock;
        }

        // If no expectations, early return
        if ($setExpectations === null) {
            return $mock;
        }

        // Pass mock to closure to set expectations
        $setExpectations($mock);

        return $mock;
    }
}