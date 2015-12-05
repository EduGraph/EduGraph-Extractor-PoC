<?php

require 'vendor/autoload.php';

require 'functions.php';

/* config */
$sourceFormat = 'detect';
$targetFormat = 'n3';

/* URLs */

$urls[] = 'http://trustafriend.com/reviews/the-dog-toby-carvery-over-gloucester/';
$urls[] = 'http://southernafricatravel.com/destination/south_africa/cape_town_peninsula/';

echo '<h1>RDF Extractor</h1>';
echo '<h2>Extraction-Report</h2>';

foreach ($urls as $url) {

    echo '<h3>' . $url . '</h3>';

    $data = extractRdfFromUrl($url)->getBody();
    $response = postData($data);

    echo '<img src="https://http.cat/'.$response->getStatusCode().'" height="200px"/>"';
    echo $response->getBody();
}
?>
