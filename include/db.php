<?php
include ($_SERVER['DOCUMENT_ROOT'].'/trackme/config.php');

$strDbLocation = 'mysql:dbname='.$datenbank.';host='.$host.'';
$strDbUser = $benutzer;
$strDbPassword = $passwort;

try
{
  $db = new PDO($strDbLocation, $strDbUser, $strDbPassword);
}
catch (PDOException $e)
{
  echo 'Datenbank-Fehler: ' . $e->getMessage();
  die();
}
?>
