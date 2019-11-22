<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Providers;

use Commissioner\CommissionTask\Interfaces\MathInterface;
use Commissioner\CommissionTask\Service\Math;
use Illuminate\Support\ServiceProvider;

class MathServiceProvider extends ServiceProvider
{
    /**
     * Path to commission config.
     *
     * @const string
     */
    const MATH_CONFIG = __DIR__ . '../config/math.php';

    /**
     * Boot math service.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([self::MATH_CONFIG]);
    }

    /**
     * @return void
     */
    public function register()
    {
        // Merge config to have default values if not set
        $this->mergeConfigFrom(self::MATH_CONFIG, 'math');

        $this->app->bind(MathInterface::class, $this->getMathClosure());
    }

    /**
     * @return \Closure
     */
    private function getMathClosure(): \Closure
    {
        return function (): Math {
            $config = $this->app->get('config');

            return new Math($config->get('math.scale'));
        };
    }
}