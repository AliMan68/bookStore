<?php

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Encryption\Encrypter;

class MyCrypt {

  //default crypt key
  private static $key = '2ac590752ac59075';


  public static function encrypt($str, $key = null){
    if (is_null($key))
      $key = self::$key;
    $crypt = new Encrypter($key,"AES-128-CBC");
    try {
      $result = $crypt->encryptString($str);
    }catch (EncryptException $e){
//      $result = $e->getMessage();
      $result = '';
    }
    return $result;
  }



  public static function decrypt($encrypted, $key = null){
    if (is_null($key))
      $key = self::$key;
    $crypt = new Encrypter($key,"AES-128-CBC");
    try {
      $result = $crypt->decryptString($encrypted);
    }catch (DecryptException $e){
//      $result = $e->getMessage();
      $result = '';
    }
    return $result;
  }



}


class RsaCrypt
{

  public $pubkey = '...public key here...';
  public $privkey = '...private key here...';

  public function encrypt($data)
  {
    if (openssl_public_encrypt($data, $encrypted, $this->pubkey))
      $data = base64_encode($encrypted);
    else
      throw new Exception('Unable to encrypt data. Perhaps it is bigger than the key size?');

    return $data;
  }

  public function decrypt($data)
  {
    if (openssl_private_decrypt(base64_decode($data), $decrypted, $this->privkey))
      $data = $decrypted;
    else
      $data = '';

    return $data;
  }
}