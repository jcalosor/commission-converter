<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Tests\Service;

use Commissioner\CommissionTask\Interfaces\CommissionInterface;
use Commissioner\CommissionTask\Interfaces\MathServiceInterface;
use Commissioner\CommissionTask\Service\MathService;
use Commissioner\CommissionTask\Tests\AbstractTestCase;
use Symfony\Component\ErrorHandler\Error\ClassNotFoundError;

/**
 * @covers nothing
 */
abstract class AbstractCommissionTestCase extends AbstractTestCase
{
    /**
     * @var string
     */
    protected $limit;

    /**
     * @var int
     */
    protected $scale;

    /**
     * @var string
     */
    protected $rate;

    public function setUp()
    {
        $this->limit = '5';
        $this->rate = '0.3';
        $this->scale = 2;
    }

    /**
     * Return a resolved instance of CommissionInterface based on the provided parameters.
     *
     * @param string $commissionClass
     * @param string|null $limit
     * @param string|null $rate
     * @param int|null $scale
     *
     * @return \Commissioner\CommissionTask\Interfaces\CommissionInterface
     */
    protected function getResolvedCommissionService(
        string $commissionClass,
        string $limit = null,
        string $rate = null,
        int $scale = null
    ): CommissionInterface {
        $limit = $limit ?? $this->limit;
        $rate = $rate ?? $this->rate;
        $scale = $scale ?? $this->scale;

        $resolvedClass = new $commissionClass(new MathService(2), $limit, $rate, $scale);

        if ($resolvedClass instanceof CommissionInterface !== true) {
            throw new ClassNotFoundError(\sprintf('Not a member of %s', CommissionInterface::class));
        }

        return $resolvedClass;
    }

    /**
     * A common success test case for encash method.
     *
     * @return void
     */
    abstract public function testEncashSuccess();
}