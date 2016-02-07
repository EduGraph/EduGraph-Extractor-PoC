
# Add Geo to University

```sparql
CONSTRUCT
{
  ?universityURI a ?universityURIWikidata;
    geo:lat ?universityLatitude;
    geo:long ?universityLongitude.
}
WHERE
{
  {
  SELECT * WHERE{
?universityURI  owl:sameAs ?universitySameAs.
  FILTER regex(str(?universitySameAs),'^http://wikidata.org/entity/','i')
  BIND(URI(REPLACE(STR(?universitySameAs), "http://", "http://www.")) AS ?universityURIWikidata)
      SERVICE <http://query.wikidata.org/sparql> {
        ?universityURIWikidata wdt:P625 ?universityLatLon.

        BIND(STR(?universityLatLon) AS ?universityLatLonStr)
        BIND(STRBEFORE(STRAFTER(?universityLatLonStr, "Point("), " ") AS ?universityLatitude)
        BIND(STRBEFORE(STRAFTER(?universityLatLonStr, " "), ")") AS ?universityLongitude)
    }
  }
  }
}
```