<?php
declare(strict_types=1);

use Commissioner\CommissionTask\Service\CashIn;

return [
    'default' => [
        'fee_rate' => '0.03%'
    ],
    CashIn::class => [
        'fee_limit' => '5',
        'fee_rate' => '0.03%'
    ],
];