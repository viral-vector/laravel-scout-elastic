<?php

namespace ViralVector\LaravelScoutElastic\Console;

use Illuminate\Console\Command;
use ViralVector\LaravelScoutElastic\Services\ElasticClientBuilder;

class ElasticIndicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:indices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show Elasticsearch indices (cat command)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = ElasticClientBuilder::build();

        $indices = $client->cat()->indices();

        if(count($indices) > 0) {
            $headers = array_keys(current($indices));
            $this->table($headers, $indices);
        } else {
            $this->warn('No indices found.');
        }
    }
}
