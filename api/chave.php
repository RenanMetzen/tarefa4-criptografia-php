<?php
$extensao = pathinfo($_FILES['key']['name'], PATHINFO_EXTENSION);
$temporario = $_FILES['key']['tmp_name'];
$key2 = file_get_contents($temporario);

$extensao = pathinfo($_FILES['iv']['name'], PATHINFO_EXTENSION);
$temporario = $_FILES['iv']['tmp_name'];
$iv2 = file_get_contents($temporario);

$extensao = pathinfo($_FILES['inputTextoCifrado']['name'], PATHINFO_EXTENSION);
$temporario = $_FILES['inputTextoCifrado']['tmp_name'];
$textoCifrado2 = file_get_contents($temporario);

$extensao = pathinfo($_FILES['inputChavePrivada']['name'], PATHINFO_EXTENSION);
$temporario = $_FILES['inputChavePrivada']['tmp_name'];
$chavePrivada2 = file_get_contents($temporario);

$arrayEncrypt = [$key2, $iv2, $textoCifrado2, $chavePrivada2];

echo json_encode($arrayEncrypt);
?>
