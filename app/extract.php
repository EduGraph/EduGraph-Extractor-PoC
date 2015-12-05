<?php
/**
 * User: jonas
 * Date: 05/12/15
 * Time: 20:13
 */

require_once('functions.php');


$urls[] = 'http://trustafriend.com/reviews/the-dog-toby-carvery-over-gloucester/';
$urls[] = 'http://southernafricatravel.com/destination/south_africa/cape_town_peninsula/';

echo '<h1>Report</h1>';

foreach ($urls as $url) {
    echo '<h3>'.$url.'</h3>';
    $result = extractDocument($url);
    sendDataSparqlHTTP($result, 'POST');
    echo '<hr>';
}