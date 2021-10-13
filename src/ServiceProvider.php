<?php

namespace Thoughtco\StatamicRestrictFields;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $scripts = [
        __DIR__.'/../resources/js/RestrictConditions.js'
    ];
}
