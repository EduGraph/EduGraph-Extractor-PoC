<?php

require 'vendor/autoload.php';

require 'functions.php';

/* URLs */

$urls[] = 'http://trustafriend.com/reviews/the-dog-toby-carvery-over-gloucester/';
$urls[] = 'http://southernafricatravel.com/destination/south_africa/cape_town_peninsula/';

echo '<h1>Extraction-Report</h1>';

foreach ($urls as $url) {

    $responseExtraction = extractRdfFromUrl($url);
    $data = $responseExtraction->getBody();
    $responsePostData = postData($data);

    echo '<h2>' . $url . '</h2>';
    echo '<img src="https://http.cat/'.$responsePostData->getStatusCode().'" height="200px"/>';

    echo '<h3>Extraction</h3>';
    echo '<b>Status:</b> ' . $responseExtraction->getReasonPhrase();

    echo '<h3>Storage</h3>';
    echo '<b>Status:</b> ' . $responsePostData->getReasonPhrase() . '<br />';
    echo '<b>Message</b> ' . $responsePostData->getBody();

    echo '<hr>';
}
?>
