<?php
require_once( "lib/sparqllib.php" );


/***************************************
/*
/*      CONFIG Parameters
/*
***************************************/

define ('LANG', 'de');

define ('SPARQL_EduGraph', 'http://dbpedia.org/sparql');
define ('SPARQL_DBpediaDE', 'http://de.dbpedia.org/sparql');
define ('SPARQL_DBpedia', 'http://dbpedia.org/sparql');
define ('SPARQL_WikiData', 'http://dbpedia.org/sparql');

/***************************************/
/***************************************/


#Sparql Endpoint
$db = sparql_connect( SPARQL_DBpediaDE );


if( !$db ) { print $db->errno() . ": ". $db->error(). "\n"; exit; }


$db->ns( "owl","http://www.w3.org/2002/07/owl#");
$db->ns( "rdf","http://www.w3.org/1999/02/22-rdf-syntax-ns#");
$db->ns( "xml","http://www.w3.org/XML/1998/namespace");
$db->ns( "xsd","http://www.w3.org/2001/XMLSchema#");
$db->ns( "rdfs","http://www.w3.org/2000/01/rdf-schema#");
$db->ns( "skos","http://www.w3.org/2004/02/skos/core#");
$db->ns( "dcterms","http://www.purl.org/dc/terms/");

$db->ns( "foaf","http://xmlns.com/foaf/0.1/");
$db->ns( "schema","http://schema.org/");
$db->ns( "geo","http://www.w3.org/2003/01/geo/wgs84_pos#");

$db->ns( "dbpedia-de","http://de.dbpedia.org/resource/");
$db->ns( "dbpedia-owl","http://dbpedia.org/ontology/");
$db->ns( "dbo","http://dbpedia.org/ontology/");
$db->ns( "dbr","http://dbpedia.org/resource/");
$db->ns( "wd","http://www.wikidata.org/entity/");
$db->ns( "wdt","http://www.wikidata.org/prop/direct/");
$db->ns( "wikibase","http://wikiba.se/ontology#");



?>
