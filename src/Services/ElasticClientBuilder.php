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

        if(config('elasticsearch.ssl')){
            $client->setSSLVerification(config('elasticsearch.ssl'));
        }

        return $client->build();
    }
}
