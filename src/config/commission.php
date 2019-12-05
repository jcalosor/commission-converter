<?php

declare(strict_types=1);

use Commissioner\CommissionTask\Service\CashIn;
use Commissioner\CommissionTask\Service\CashOut;

return [
    'default' => [
        'scale' => 2,
    ],
    CashIn::class => [
        'fee_limit' => '5.00', // Maximum fee that should be returned
        'fee_rate' => '0.03%',
    ],
    CashOut::class => [
        'fee_limit' => '0.50', // Minimum fee that should be returned
        'fee_rate' => '0.3%',
    ],
];
