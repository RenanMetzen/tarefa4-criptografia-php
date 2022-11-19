<?php
include('Crypt/RSA.php');

if(isset($_POST['chaves'])){
  $arrayChaves = array();
  $rsa = new Crypt_RSA();
  extract($rsa->createKey());

  $arrayChaves = [$privatekey, $publickey];
  echo json_encode($arrayChaves);
}elseif(isset($_FILES['texto'])){
  $arrayEncrypt = array();

  ini_set( 'default_charset', 'utf-8');
  $formatosPermitidos = "txt";
  $extensao = pathinfo($_FILES['texto']['name'], PATHINFO_EXTENSION);
  $temporario = $_FILES['texto']['tmp_name'];
  $textoClaro = file_get_contents($temporario);
  str_replace('\r\n', "", $textoClaro);

  $formatosPermitidos = "txt";
  $extensao = pathinfo($_FILES['inputChavePublica']['name'], PATHINFO_EXTENSION);
  $temporario = $_FILES['inputChavePublica']['tmp_name'];
  $chavePublica = file_get_contents($temporario);
  // $chavePublica = preg_replace( "/\r|\n/", "", $chavePublica);

  $cipher = "AES-128-CBC";

  $iv = random_bytes(8);
  $iv = bin2hex($iv);

  $key = random_bytes(8);
  $key = bin2hex($key);

  $textoCifrado = openssl_encrypt($textoClaro, $cipher, $key, $options=0, $iv);

  $arrayEncrypt = [$textoCifrado, $key, $iv];

  echo json_encode($arrayEncrypt);

}else{

  $textoClaroOriginal = openssl_decrypt($textoCifrado, $cipher, $key, $options=0, $iv);

}
?>

