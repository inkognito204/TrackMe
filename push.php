<?php

include 'config.php';

@$db = new mysqli($host, $benutzer, $passwort, $datenbank);

if (mysqli_connect_errno()) {
        printf("Verbindung fehlgeschlagen: %s\n", mysqli_connect_error());
        exit();
    }
    
if (isset($_GET['user'])) {
    $data['user'] = $_GET['user'];
    $data['track'] = $_GET['track'];
    $data['time'] = $_GET['time'];
    $data['lat'] = $_GET['lat'];
    $data['lon'] = $_GET['lon'];
    $data['alt'] = $_GET['alt'];
    $data['speed'] = $_GET['speed'];
    $data['bearing'] = $_GET['bearing'];
    $data['acc'] = $_GET['acc'];
    
    writeTrack($data);
}

function writeTrack($data) {
    
    global $db;
    
    $time = date('d.m.Y H:m:s', $data['time']);
    
    
    $sql = "
        INSERT INTO `track_data` (`user`, `track`, `time`, `lat`, `lon`, `alt`, `speed`, `bearing`, `acc`, `insert`)
        VALUES
        ('".$data['user']."', '".$data['track']."', '{$data['time']}', '".$data['lat']."', '".$data['lon']."', '{$data['alt']}', '{$data['speed']}', '{$data['bearing']}', '{$data['acc']}', NOW())";
    
    if ($db->query($sql)) {
        return true;
    } else {
        return false;
    }
}

?>
