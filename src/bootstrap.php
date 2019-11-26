<?php

declare(strict_types=1);

// Instantiate the container
use Commissioner\CommissionTask\Interfaces\CashInInterface;
use Commissioner\CommissionTask\Interfaces\CashOutInterface;
use Commissioner\CommissionTask\Interfaces\CSVToEntityMapperInterface;
use Commissioner\CommissionTask\Interfaces\CurrencyConverterInterface;
use Commissioner\CommissionTask\Interfaces\MathServiceInterface;
use Commissioner\CommissionTask\Service\CashIn;
use Commissioner\CommissionTask\Service\CashOut;
use Commissioner\CommissionTask\Service\CSVToEntityMapper;
use Commissioner\CommissionTask\Service\CurrencyConverter;
use Commissioner\CommissionTask\Service\MathService;

$app = new Illuminate\Container\Container();

with(new Illuminate\Events\EventServiceProvider($app))->register();

$config = new \Noodlehaus\Config($basePath.'config');

$app->bind(
    MathServiceInterface::class,
    function () use ($config): MathService {
        return new MathService((int) $config->get('default')['scale']);
    }
);

$app->bind(
    CurrencyConverterInterface::class,
    function () use ($app, $config): CurrencyConverter {
        return new CurrencyConverter($app->get(MathServiceInterface::class), $config->get('currency_map'));
    }
);

$app->bind(
    CashInInterface::class,
    function () use ($app, $config): CashIn {
        return new CashIn(
            $app->get(MathServiceInterface::class),
            $config->get(CashIn::class)['fee_limit'],
            $config->get('default')['fee_rate'],
            (int) $config->get('default')['scale']
        );
    }
);

$app->bind(
    CashOutInterface::class,
    function () use ($app, $config): CashOut {
        return new CashOut(
            $app->get(MathServiceInterface::class),
            $config->get(CashOut::class)['fee_limit'],
            $config->get('default')['fee_rate'],
            (int) $config->get('default')['scale']
        );
    }
);

$app->bind(
    CSVToEntityMapperInterface::class,
    function () use ($config): CSVToEntityMapper {
        return new CSVToEntityMapper(
            $config->get(CSVToEntityMapper::class)['delimiter'],
            $config->get(CSVToEntityMapper::class)['directory_path'],
            $config->get(CSVToEntityMapper::class)['length'],
            $config->get(CSVToEntityMapper::class)['person_data']
        );
    }
);
