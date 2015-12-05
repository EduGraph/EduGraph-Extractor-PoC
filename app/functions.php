<?php

function extractDocument($url){

    $serviceURL = 'http://rdf-translator.appspot.com/convert/detect/n3/';

    $pageToExtract = $url;

    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, $serviceURL.urlencode($pageToExtract));

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec ($curl);

    #$headerSent = curl_getinfo($curl, CURLINFO_HEADER_OUT ); // request headers

    echo '<pre>';
    #print_r($headerSent);
    curl_close ($curl);
    #print $result;
    echo '</pre>';

    return $result;
}

function sendDataSparqlHTTP($data, $method){
    $sparqlEndpoint = 'http://fbwsvcdev.fh-brandenburg.de:8080/fuseki/biseExtract/data?default';

    $HTTPheader = array(
        'Content-Type: text/turtle',
        'Content-Length: ' . strlen($data)
    );


    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, $sparqlEndpoint);

    if($method == 'POST'){
        curl_setopt($curl, CURLOPT_POST, 1);
    }
    elseif ($method == 'PUT'){
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    }

    curl_setopt($curl, CURLOPT_HTTPHEADER, $HTTPheader);

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);


    curl_setopt($curl, CURLINFO_HEADER_OUT, true); // enable tracking
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec ($curl);

    $headerSent = curl_getinfo($curl, CURLINFO_HEADER_OUT ); // request headers

    echo '<pre>';
    print_r($headerSent);

    curl_close ($curl);

    print $result;
    echo '</pre>';
}