<?php
include('Crypt/RSA.php');

if(isset($_POST['chaves'])){
  $arrayChaves = array();
  $rsa = new Crypt_RSA();
  extract($rsa->createKey());

  $arrayChaves = [$privatekey, $publickey];
  echo json_encode($arrayChaves);
}elseif(isset($_FILES['texto'])){
  ini_set( 'default_charset', 'utf-8');
  $formatosPermitidos = "txt";
  $extensao = pathinfo($_FILES['texto']['name'], PATHINFO_EXTENSION);
  $temporario = $_FILES['texto']['tmp_name'];
  $palavra = file_get_contents($temporario);


  $arrayChaves = [$palavra];

  echo json_encode($arrayChaves);
}
?>

