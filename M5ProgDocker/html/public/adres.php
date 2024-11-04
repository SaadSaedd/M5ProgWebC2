<?php


include_once("../source/database.php");

$connection = database_connect();

$result = $connection->query("SELECT * from adres ");
$result2 = $connection->query("SELECT * from persoon ");


print_r($result->fetch_all());
print_r($result2->fetch_all());



<?php


include_once("../source/database.php");

$connection = database_connect();

$result = $connection->query("SELECT * from boek");

print_r($result->fetch_all());

?>