<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Tests\Service;

use Commissioner\CommissionTask\Entities\PersonsNatural;
use Commissioner\CommissionTask\Service\CashIn;

/**
 * @covers \Commissioner\CommissionTask\Service\CashIn
 */
class CashInTest extends AbstractCommissionTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->rate = '0.03';
    }

    /**
     * Test should assert that the commission fee is just 0.3% of the provided amount,
     * and the return is the limit value.
     *
     * @return void
     */
    public function testCashInSuccessLimitReturned()
    {
        $cashIn = $this->getResolvedCommissionService(CashIn::class, $this->limit);

        self::assertSame('5', $this->limit);
        self::assertSame($this->limit, $cashIn->encash(new PersonsNatural(['operation_amount' => '50000']), '50000'));
    }

    /**
     * Test should assert that the commission fee is just 0.3% of the provided amount,
     * and not greater than 5 EUR.
     *
     * @return void
     */
    public function testEncashSuccess()
    {
        $cashIn = $this->getResolvedCommissionService(CashIn::class);

        self::assertSame('0.06', $cashIn->encash(new PersonsNatural(['operation_amount' => '200']), '200'));
    }
}