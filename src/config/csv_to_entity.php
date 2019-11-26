<?php

declare(strict_types=1);

use Commissioner\CommissionTask\Service\CSVToEntityMapper;

return [
    CSVToEntityMapper::class => [
        'delimiter' => ',',
        'directory_path' => \dirname(__FILE__).'/../../public/',
        'length' => 9999,
        'person_data' => [],
    ],
];
