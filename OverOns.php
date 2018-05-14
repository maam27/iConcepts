<?php
require_once 'partial/page_head.php';
?>
    <title>Over Ons EenmaalAndermaal</title>
    </head>

    <body>
<?php
include_once 'partial/menu.php';
?>
    <main>
        <div class="container">
        <div class="row">
            <div class = "col-12">
            <h1> Over Ons </h1>
            <p>iConcepts is een bedrijf dat betrouwbaarheid hoog in het vaandel heeft staan. <BR>
               Dit willen we graag overbrengen in onze dienstverlening, waarbij we geen onderscheid maken tussen het persoonlijke danwel het digitale contact. </BR></p>
            <p>Wij van iConcepts willen graag een veilingsite EenmaalAndermaal openen, waarop gebruikers hun voorwerpen ter verkoop aanbieden en anderen bij opbod die voorwerpen kunnen kopen.
               We hebben gemerkt dat door de economische crisis mensen sneller teruggrijpen naar tweedehands artikelen.
               Daarnaast levert het een bijdrage aan de verduurzaming van de samenleving.
               Enkele grote veilingwebsites floreren, zonder échte concurrentie te hebben. Dit gat willen wij vullen.</p>
               <br>
            </div>
            <div class ="col-6">
          <h1>Contact</h1>
          <ul>
            <li>iConcepts</li>
            <li>Ruitenberglaan 26</li>
            <li>6826 CC Arnhem</li>
            <li>Postbus 2217</li>
            <li><a href = mailto:IProjectGroep14@hotmail.com>IProjectGroep14@hotmail.com</a></li>
            <li><a href = tel:(026) 369 19 11>(026) 369 19 11</a></li>
          </div>
          <div class="col-6">
            <div id="map" style="width:300px;height:300px;">
          </div>
          </div>
<script>
function myMap() {
    var mapOptions = {
        center: new google.maps.LatLng(51.9881152, 5.9475224999999991),
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.MAP
    }
var map = new google.maps.Map(document.getElementById("map"), mapOptions);
//var marker = new google.maps.Marker({position: 51.9881152, 5.9475224999999991 ,map: map});
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"
  type="text/javascript"></script>
        </div>
    </main>

<?php require_once 'partial/page_footer.php';?>
