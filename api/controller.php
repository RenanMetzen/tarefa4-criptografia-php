<?php
include('Crypt/RSA.php');

if(isset($_POST['chaves'])){
  $arrayChaves = array();
  $rsa = new Crypt_RSA();
  extract($rsa->createKey(2048, 10));

  $arrayChaves = [$privatekey, $publickey];
  echo json_encode($arrayChaves);
}elseif(isset($_FILES['texto'])){
  $arrayEncrypt = array();
  define('CRYPT_RSA_PKCS15_COMPAT', true);
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
  // $chavePublica = openssl_pkey_get_public($temporario);

  $cipher = "AES-128-CBC";
  $iv = random_bytes(16);
  $key = random_bytes(16);

  $textoCifrado = openssl_encrypt($textoClaro, $cipher, $key, $options=0, $iv);
  
  $iv = bin2hex($iv);
  $key = bin2hex($key);

  $arrayEncrypt = [$textoCifrado, $key, $iv, $chavePublica];

  echo json_encode($arrayEncrypt);

}else{
  $textoClaroOriginal = array();
  define('CRYPT_RSA_PKCS15_COMPAT', true);
  ini_set( 'default_charset', 'utf-8');

  
  $textoCifrado = $_POST['textoCifrado'];
  $key = $_POST['key'];
  $iv = $_POST['iv'];

  $cipher = "AES-128-CBC";
  $iv = hex2bin($iv);
  $key = hex2bin($key);

  $textoClaroOriginal = openssl_decrypt($textoCifrado, $cipher, $key, $options=0, $iv);

  echo json_encode($textoClaroOriginal);
}
?>

