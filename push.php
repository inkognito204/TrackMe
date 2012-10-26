<?php

include ("/include/db.php");

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
        
    $insertsql = $db->prepare(
        "INSERT INTO `track_data` (`user`, `track`, `time`, `lat`, `lon`, `alt`, `speed`, `bearing`, `acc`, `insert`)
        VALUES
        (:user, :track, :time, :lat, :lon, :alt, :speed, :bearing, :acc, NOW())"
        );
    
    $insertsql->bindParam('user', $data['user']);
    $insertsql->bindParam('track', $data['track']);
    $insertsql->bindParam('time', $data['time']);
    $insertsql->bindParam('lat', $data['lat']);
    $insertsql->bindParam('lon', $data['lon']);
    $insertsql->bindParam('alt', $data['alt']);
    $insertsql->bindParam('speed', $data['speed']);
    $insertsql->bindParam('bearing', $data['bearing']);
    $insertsql->bindParam('acc', $data['acc']);
    
    try
    {
        $insertsql->execute();
        $db = null;
        return true;
    }
    catch (PDOException $e)
    {
        echo 'Datenbank-Fehler: ' . $e->getMessage();
        $db = null;
        return false;
    }

}

?>
