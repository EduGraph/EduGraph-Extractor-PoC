<?php
header('content-type: text/plain;charset=utf8');

require 'vendor/autoload.php';


$client = new GuzzleHttp\Client([
    'base_uri' => 'http://de.dbpedia.org',
    // You can set any number of default request options.
    // 'timeout'  => 2.0,
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

$universities[] = 'dbpedia-de:Fachhochschule_Brandenburg';
$universities[] = 'dbpedia-de:Hochschule_Fulda';
$universities[] = '<http://de.dbpedia.org/resource/TH_Köln>';
$universities[] = '<http://de.dbpedia.org/resource/Fachhochschule_Technikum_Wien>';
$universities[] = '<http://de.dbpedia.org/resource/Zürcher_Hochschule_für_Angewandte_Wissenschaften>';
$universities[] = '<http://de.dbpedia.org/resource/Fachhochschule_Flensburg>';
$universities[] = '<http://de.dbpedia.org/resource/Ostbayerische_Technische_Hochschule_Regensburg>';


$error = 0;



foreach ($universities as $university) {
    $statements[] = "$university rdfs:label ?universityLabel.";
    $statements[] = "$university rdfs:comment ?universityComment.";
    $statements[] = "$university dbo:abstract ?universityAbstract.";
    $statements[] = "$university dbpedia-owl:locationCity ?universityLocation.";
    $statements[] = "$university owl:sameAs ?universitySameAs.";
    $statements[] = "$university foaf:homepage ?universityHomepage.";
    $statements[] = "$university dbpedia-owl:thumbnail ?universityThumbnail.";

    foreach ($statements as $statement) {
        $query = $prefix . "
            CONSTRUCT
            WHERE
            {
                $statement
            }
            ";
        $response = $client->request('GET', '/sparql', ['query' => [
            'query' => $query
        ]]);

        if($response->getBody() != "# Empty TURTLE\n"){

            echo $response->getBody();
        }
        else {

            $error++;

        }


    }





    /*$response = $client->request('GET', '/sparql', ['query' => [
        'query' => $sparql
    ]]);

    echo $response->getBody();*/
    //echo $sparql .'<br /><hr><br />';
}


echo "<h1>$error</h1>";