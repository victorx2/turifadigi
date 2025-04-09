<?php

namespace App\controllers;

class CriptografiaController
{
  private $key;
  private $cipher = "AES-256-CBC";
  private $iv;

  public function __construct()
  {
    $this->key = $_ENV['APP_KEY'];
    $this->iv = substr(hash('sha256', $this->key), 0, 16);
  }

  public function desencriptacion($password)
  {
    return openssl_decrypt(
      base64_decode($password),
      $this->cipher,
      $this->key,
      0,
      $this->iv
    );
  }

  public function encriptacion($password)
  {
    return base64_encode(
      openssl_encrypt(
        $password,
        $this->cipher,
        $this->key,
        0,
        $this->iv
      )
    );
  }
}
