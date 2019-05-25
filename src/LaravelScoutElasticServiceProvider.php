<?php

namespace ViralVector\LaravelScoutElastic;

use Laravel\Scout\EngineManager;
use Illuminate\Support\ServiceProvider;
use ViralVector\LaravelScoutElastic\Console\ElasticIndicesCommand;
use ViralVector\LaravelScoutElastic\Console\ElasticMakeIndicesCommand;
use ViralVector\LaravelScoutElastic\Services\ElasticClientBuilder;

class LaravelScoutElasticServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        app(EngineManager::class)->extend('elasticsearch', function($app) {
            return new ElasticsearchEngine(ElasticClientBuilder::build(),
                config('elasticsearch.queries')
            );
        });
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ElasticIndicesCommand::class,
                ElasticMakeIndicesCommand::class
            ]);

            $this->publishes([
                __DIR__ . '/../config/elasticsearch.php' => config_path('elasticsearch.php'),
            ]);
        }
    }
}
