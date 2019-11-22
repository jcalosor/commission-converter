<?php
declare(strict_types=1);

// Instantiate the container
use Commissioner\CommissionTask\Interfaces\CashInInterface;
use Commissioner\CommissionTask\Interfaces\MathInterface;
use Commissioner\CommissionTask\Service\CashIn;
use Commissioner\CommissionTask\Service\Math;

$app = new Illuminate\Container\Container();

with(new Illuminate\Events\EventServiceProvider($app))->register();

$config = new \Noodlehaus\Config($basePath . 'config');

$app->bind(
    MathInterface::class,
    function () use ($config): Math {
        return new Math((int)$config->get('scale'));
    }
);

$app->bind(
    CashInInterface::class,
    function () use ($app, $config): CashIn {
        return new CashIn(
            $app->get(MathInterface::class),
            $config->get(CashIn::class)['fee_limit'],
            $config->get(CashIn::class)['fee_rate']
        );
    }
);

/** @var \Commissioner\CommissionTask\Interfaces\CashInInterface $cash */
$cash = $app->get(CashInInterface::class);
echo $cash->encash((string)100);