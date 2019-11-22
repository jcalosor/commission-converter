<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;

/**
 * @covers nothing
 */
abstract class AbstractCommissionTestCase extends TestCase
{
    /**
     * @var string
     */
    protected $limit;

    /**
     * @var int
     */
    protected $scale;

    public function setUp()
    {
        $this->limit = '5';
        $this->scale = 2;
    }

    /**
     * A common success test case for encash method.
     *
     * @return void
     */
    abstract public function testEncashSuccess();
}