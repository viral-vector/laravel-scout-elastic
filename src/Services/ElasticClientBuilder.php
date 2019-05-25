<?php

namespace ViralVector\LaravelScoutElastic\Services;

use Elasticsearch\ClientBuilder;

class ElasticClientBuilder
{
    /**
     * Build Elastic Client
     */
    public static function build()
    {
        $client = ClientBuilder::create()
            ->setHosts(config('elasticsearch.hosts'));

        if(count(array_filter(config('elasticsearch.ssl'))) > 0){
            $client->setSSLVerification(config('elasticsearch.ssl'));
        }

        return $client->build();
    }
}
