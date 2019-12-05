<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Tests\Service;

use Commissioner\CommissionTask\Entities\PersonsLegal;
use Commissioner\CommissionTask\Service\CashOut;

/**
 * @covers \Commissioner\CommissionTask\Service\CashOut
 */
class CashOutTest extends AbstractCommissionTestCase
{
    /**
     * Replaces the default value in the abstract test case.
     */
    public function setUp()
    {
        parent::setUp();

        $this->limit = '0.50';
    }

    /**
     * Test should assert that the commission fee is just 0.3% of the provided amount.
     *
     * @return void
     */
    public function testEncashSuccess()
    {
        $cashOut = $this->getResolvedCommissionService(CashOut::class, $this->limit);
        self::assertSame('0.3', $this->rate);
        self::assertSame(
            '9000.00',
            $cashOut->encash(new PersonsLegal(['operation_amount' => '3000000']), '3000000')
        );
    }

    /**
     * Test should assert that the commission fee is just 0.3% of the provided amount,
     * and the return is the limit value.
     *
     * @return void
     */
    public function testCashOutSuccessMinimumLimitReturned()
    {
        $cashOut = $this->getResolvedCommissionService(CashOut::class, $this->limit);
        self::assertSame('0.3', $this->rate);
        self::assertSame(
            '0.50',
            $cashOut->encash(new PersonsLegal(['operation_amount' => '100']), '100')
        );
    }
}