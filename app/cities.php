<?php
header('content-type: text/plain;charset=utf8');

require 'vendor/autoload.php';
$error = 0;

$client = new GuzzleHttp\Client([
    'base_uri' => 'http://dbpedia.org'
]);

$prefix = "
    PREFIX schema: <http://schema.org/>
    PREFIX dcterms: <http://purl.org/dc/terms/>
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX owl: <http://www.w3.org/2002/07/owl#>
    PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
    PREFIX foaf: <http://xmlns.com/foaf/0.1/>

    PREFIX dbpedia-de: <http://de.dbpedia.org/resource/>
    PREFIX dbpedia-owl: <http://dbpedia.org/ontology/>
    PREFIX dbo: <http://dbpedia.org/ontology/>
    PREFIX dbr: <http://dbpedia.org/resource/>
    PREFIX wd: <http://www.wikidata.org/entity/>
    PREFIX wdt: <http://www.wikidata.org/prop/direct/>
    PREFIX wikibase: <http://wikiba.se/ontology#>

    PREFIX geo: <http://www.w3.org/2003/01/geo/wgs84_pos#>";

$cities[] = 'dbr:Brandenburg_an_der_Havel';
$cities[] = 'dbr:Fulda';
$cities[] = '<http://dbpedia.org/resource/Cologne>';
$cities[] = '<http://dbpedia.org/resource/Vienna>';
$cities[] = '<http://dbpedia.org/resource/Z%C3%BCrich>';
$cities[] = '<http://dbpedia.org/resource/Flensburg>';
$cities[] = '<http://dbpedia.org/resource/Regensburg>';



foreach ($cities as $city) {


    $query =  $prefix ."
            CONSTRUCT
            WHERE {
                $city rdfs:label ?label;
                    rdfs:comment ?comment;
                    dbo:abstract ?abstract;
                    foaf:homepage ?homepage;
                    dbo:thumbnail ?thumbnail;
                    foaf:depiction ?depiction;
                    foaf:isPrimaryTopicOf ?wikipediaPage.
                }
            ";
    $response = $client->request('GET', '/sparql', ['query' => [
        'query' => $query
    ]]);




    //echo $response->getStatusCode();
    if($response->getBody() != "# Empty TURTLE\n"){

        echo $response->getBody();
    }
    else {

        $error++;

    }

}

//echo "Errors: $error";