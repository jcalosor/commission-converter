<?php
declare(strict_types=1);

namespace Commissioner\CommissionTask\Interfaces;

interface ServiceProviderInterface
{
    /**
     * Boot commission services.
     *
     * @return void
     */
    public function boot();

    /**
     * Register commission services.
     *
     * @return void
     */
    public function register();
}