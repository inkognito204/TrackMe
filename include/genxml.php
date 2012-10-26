<?php
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

include ("db.php");

$sql = "SELECT * FROM track_data WHERE 1";

try
    {
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e)
    {
        echo 'Datenbank-Fehler: ' . $e->getMessage();
        die();
    }

header("Content-type: text/xml"); 

while ($row = $result->fetch()){ 
  $node = $dom->createElement("marker");  
  $newnode = $parnode->appendChild($node);   
  $newnode->setAttribute("track",$row['track']);
  $newnode->setAttribute("user", $row['user']);  
  $newnode->setAttribute("lat", $row['lat']);  
  $newnode->setAttribute("lon", $row['lon']);
  $newnode->setAttribute("type", "cache");
} 

$db = null;
echo $dom->saveXML();

?>
