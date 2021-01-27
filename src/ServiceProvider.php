<?php

namespace Einself\DnsValidator;

use Illuminate\Support\ServiceProvider as Base;

class ServiceProvider extends Base
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton(\Einself\DnsValidator\Contracts\DnsValidator::class, DnsValidator::class);
    }
}