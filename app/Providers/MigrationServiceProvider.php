<?php namespace App\Providers;

use App\Illuminate\Database\Migrations\DatabaseMigrationRepository;

class MigrationServiceProvider extends \Illuminate\Database\MigrationServiceProvider {

    /**
     * Register the migration repository service.
     *
     * @return void
     */
    protected function registerRepository()
    {
        $this->app->singleton('migration.repository', function($app)
        {
            $table = $app['config']['database.migrations'];

            return new DatabaseMigrationRepository($app['db'], $table);
        });
    }
}