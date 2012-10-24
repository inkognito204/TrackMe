<?php
require '../config.php';

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

@$db = new mysqli($host, $benutzer, $passwort, $datenbank);

if (mysqli_connect_errno()) {
        printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
        exit();
    }

$sql = "SELECT * FROM track_data WHERE 1";
$result = $db->query($sql);
if (!$result) {
    die('Falsches Query: '.mysqli_error());
}

header("Content-type: text/xml"); 

while ($row = @mysqli_fetch_assoc($result)){  
  $node = $dom->createElement("marker");  
  $newnode = $parnode->appendChild($node);   
  $newnode->setAttribute("track",$row['track']);
  $newnode->setAttribute("user", $row['user']);  
  $newnode->setAttribute("lat", $row['lat']);  
  $newnode->setAttribute("lon", $row['lon']);
  $newnode->setAttribute("type", "cache");
  
} 

echo $dom->saveXML();

?>
