<?php

declare(strict_types=1);

use Commissioner\CommissionTask\Service\CashIn;
use Commissioner\CommissionTask\Service\CashOut;

return [
    'default' => [
        'fee_rate' => '0.03%',
        'scale' => 2,
    ],
    CashIn::class => [
        'fee_limit' => '5', // Maximum fee that should be returned
    ],
    CashOut::class => [
        'fee_limit' => '0.50', // Minimum fee that should returned
    ],
];
