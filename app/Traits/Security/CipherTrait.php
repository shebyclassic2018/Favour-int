<?php

namespace App\Traits\Security;

use Exception;
use App\Http\Controllers\API\Algorithms\RsaCrypt;
use App\Http\Controllers\API\Algorithms\openapirsa;
use Illuminate\Contracts\Encryption\DecryptException;


trait CipherTrait
{

  protected function cipher_encrypt_urlParams($data)
  {
    return encrypt($data);
  }

  protected function cipher_decrypt_urlParams($encryptedValue)
  {
    try {
      return json_decode(decrypt($encryptedValue));
    } catch (DecryptException $e) {
      // return $e->getMessage();
      return false;
    }
  }

  protected function cipher_encrypt($data) {
    $crypt = new RsaCrypt();
    $crypt->genKeys(1024);
    $crypt->setPublicKey(storage_path('oauth-public.key'));
    return $crypt->encrypt($data);
  }

  protected function cipher_decrypt($data) {
    try {
      $crypt = new RsaCrypt();
      $crypt->setPrivateKey(storage_path('oauth-private.key'));
      return json_decode($crypt->decrypt($data));
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  protected function cipher_decrypt_openapi($data) {
    $crypt = new openapirsa();
    $crypt->genKeys(1024);
    $crypt->setPublicKey(storage_path('openapi_public.key'));
    return $crypt->encrypt($data);
  }

  protected function cipher_encrypt_openapi($data)
  {
    try {
      $crypt = new openapirsa();
      $crypt->setPrivateKey(storage_path('oauth-private.key'));
      return json_decode($crypt->decrypt($data));
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }


  /**
   * Encrypt the string containing customer details with the IV and secret
   * key provided in the developer portal
   *
   * @return $encryptedPayload
   */
  public function cipher_big_encrypt($ivKey, $secretKey, $payload = [])
  {
    // The encryption method to be used:
    $encrypt_method = "AES-256-CBC";
    // Hash the secret key:
    $key = hash('sha256', $secretKey);
    // Hash the iv - encrypt method AES-256-CBC expects 16 bytes:
    $iv = substr(hash('sha256', $ivKey), 0, 16);
    $encrypted = openssl_encrypt(json_encode($payload, true), $encrypt_method, $key, 0, $iv);
    // Base 64 Encode the encrypted payload:
    $encryptedPayload = base64_encode($encrypted);
    return $encryptedPayload;
  }
}