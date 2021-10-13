<?php

namespace Thoughtco\RestrictFields;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $listen = [
        'Statamic\Events\EntryBlueprintFound' => [
            Listeners\RestrictFieldsListener::class,
        ],
    ];
}
