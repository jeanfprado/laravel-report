<?php

namespace Jeanfprado\LaravelReport;

use Illuminate\Support\ServiceProvider;

class LaravelReportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Jeanfprado\LaravelReport\Console\ReportMakeCommand::class,
            ]);
        }
    }
}
