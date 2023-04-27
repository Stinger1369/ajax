<?php
require __DIR__ . '/../vendor/autoload.php';
// Chargement du fichier .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Map
{
  private $latitude;
  private $longitude;
  private $ville;

  public function __construct($villeId, $villeName)
  {
    $this->ville = $villeName;
    $apiKey = $_ENV['API_KEY'];
    $url = 'https://api.opencagedata.com/geocode/v1/json?q=' . urlencode($this->ville) . '&key=' . $apiKey;
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    $this->latitude = $data['results'][0]['geometry']['lat'];
    $this->longitude = $data['results'][0]['geometry']['lng'];
  }

  public function getMapHTML()
  {
    $map = "<div id=\"mapid\" style=\"height: 400px;\"></div>\n";
    $map .= "<script>\n";
    $map .= "var mymap = L.map('mapid').setView([" . $this->latitude . ", " . $this->longitude . "], 13);\n";
    $map .= "L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {\n";
    $map .= "attribution: 'Carte fournie par <a href=\"https://www.openstreetmap.org/\">OpenStreetMap</a>'\n";
    $map .= "}).addTo(mymap);\n";
    $map .= "var marker = L.marker([" . $this->latitude . ", " . $this->longitude . "]).addTo(mymap);\n";
    $map .= "marker.bindPopup('<b>" . $this->ville . "</b>').openPopup();\n";
    $map .= "</script>\n";
    return $map;
  }
}