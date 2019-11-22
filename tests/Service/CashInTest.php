<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Tests\Service;

use Commissioner\CommissionTask\Service\CashIn;

/**
 * @covers \Commissioner\CommissionTask\Service\CashIn
 */
class CashInTest extends AbstractCommissionTestCase
{
    /**
     * Test should assert that the commission fee is just 0.3% of the provided amount,
     * and the return is the limit value.
     *
     * @return void
     */
    public function testCashInSuccessLimitReturned()
    {
        self::assertEquals($this->limit, (new CashIn($this->limit, '0.3', $this->scale))->encash('50000'));
    }

    /**
     * Test should assert that the commission fee is just 0.3% of the provided amount,
     * and not greater than 5 EUR.
     *
     * @return void
     */
    public function testEncashSuccess()
    {
        self::assertEquals('.50', (new CashIn($this->limit, '0.3', $this->scale))->encash('168'));
    }
}