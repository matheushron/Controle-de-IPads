<?php
require VENDOR . 'autoload.php';

use \Elasticsearch\ClientBuilder;

class Elasticsearch {
    
    public $client;
    
    public function __construct(){
        
        $hosts = [
          [
            'host' => 'intranet.web',
            'port' => '9200',
            'scheme' => 'http',
            'user' => 'elastic',
            'pass' => 'mrj@1906'
          ]
        ];
        
        $this->client = ClientBuilder::create()
        ->setHosts($hosts)
        ->build();
    }
}
