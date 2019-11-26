<?php

declare(strict_types=1);

use Commissioner\CommissionTask\Interfaces\CashInInterface;
use Commissioner\CommissionTask\Interfaces\CashOutInterface;

return [
    'service_mapper' => [
        'cash_in' => CashInInterface::class,
        'cash_out' => CashOutInterface::class,
    ],
];
