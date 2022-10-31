<?php
include('Crypt/RSA.php');

if($_POST['tipo'] == 'gerarChaves'){
  $arrayChaves = array();
  $rsa = new Crypt_RSA();
  extract($rsa->createKey());

  $arrayChaves = [$privatekey, $publickey];

  // $chavePrivada = fopen((__DIR__) . '/chave.pr.txt', "w") or die("Unable to open file!");
  // $txt = $privatekey;
  // fwrite($chavePrivada, $txt);
  // fclose($chavePrivada);

  // $chavePublica = fopen((__DIR__) . '/chave.pu.txt', "w") or die("Unable to open file!");
  // $txt = $publickey;
  // fwrite($chavePublica, $txt);
  // fclose($chavePublica);
  echo json_encode($arrayChaves);
}
?>

