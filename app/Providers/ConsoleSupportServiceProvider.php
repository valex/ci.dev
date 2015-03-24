<?php namespace App\Providers;

use Illuminate\Support\AggregateServiceProvider;

class ConsoleSupportServiceProvider extends AggregateServiceProvider {
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        'Illuminate\Auth\GeneratorServiceProvider',
        'Illuminate\Console\ScheduleServiceProvider',
        'App\Providers\MigrationServiceProvider',
        'Illuminate\Database\SeedServiceProvider',
        'Illuminate\Foundation\Providers\ComposerServiceProvider',
        'Illuminate\Queue\ConsoleServiceProvider',
        'Illuminate\Routing\GeneratorServiceProvider',
        'Illuminate\Session\CommandsServiceProvider',
    ];

}