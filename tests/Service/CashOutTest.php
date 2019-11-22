<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Tests\Service;

use Commissioner\CommissionTask\Service\CashOut;

class CashOutTest extends AbstractCommissionTestCase
{

    /**
     * Test should assert that the commission fee is just 0.3% of the provided amount.
     *
     * @return void
     */
    public function testEncashSuccess()
    {
        self::assertEquals('.50', (new CashOut($this->limit, '0.3', $this->scale))->encash('168'));
    }
}