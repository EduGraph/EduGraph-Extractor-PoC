<?php

function extractRdfFromUrl($url){
    $service = 'http://rdf-translator.appspot.com/convert';
    $sourceFormat = 'detect';
    $targetFormat = 'n3';

    $client = new GuzzleHttp\Client(['base_uri' => $service.'/'.$sourceFormat.'/'.$targetFormat.'/']);

    $response = $client->request('GET', urlencode($url));

    return $response;
}


function postData($data){

    $client = new GuzzleHttp\Client(['base_uri' => 'http://fbwsvcdev.fh-brandenburg.de:8080/fuseki/biseExtract/']);
    $response = $client->request('POST', 'data?graph='.date("Y-m-d"), [
        'headers' => [
            'Content-Type' => 'text/turtle'
        ],
        'body' => $data
    ]);


    return $response;

}