function get_category_view($dbh, $filter){
//    expirimenting multiple page results
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$results_per_page = 30; //  offset number of results per page
$start_from = ($page-1) * $results_per_page;
$sql = "select v.*, r.Rubrieknaam, r.Rubrieknummer, Filenaam from voorwerp v
inner join VoorwerpInRubriek k on v.Voorwerpnummer = k.Voorwerp
left join Rubriek r on k.RubriekOpLaagsteNiveau = r.Rubrieknummer
inner join Bestand B on v.Voorwerpnummer = b.Voorwerp  ORDER BY Voorwerpnummer asc offset " . $start_from . " ROWS FETCH NEXT " . $results_per_page . " ROWS ONLY";


//    end expiriment

//$query = "select top 30 v.*, r.Rubrieknaam, r.Rubrieknummer, Filenaam from voorwerp v
//inner join VoorwerpInRubriek k on v.Voorwerpnummer = k.Voorwerp
//left join Rubriek r on k.RubriekOpLaagsteNiveau = r.Rubrieknummer
//inner join Bestand B on v.Voorwerpnummer = b.Voorwerp" . $filter;

$statement = $dbh->query($sql);
$statement->execute();
return $result = $statement->fetchAll();
}