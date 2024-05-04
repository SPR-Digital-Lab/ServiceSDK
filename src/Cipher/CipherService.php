<?php

namespace SPR\ServiceSDK\Cipher;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CipherService
{

    const STANDARD_TTL = 60 * 15;

    public static function CipherUser($profile, $session = null)
    {
        $cipher = new CipherUser();
        $cipher->profile = $profile;
        $cipher->session = $session;
        return $cipher;
    }

    public static function SessionAccessToken()
    {
        return session()->get('sd_cipher_access_token', null);
    }


    public static function Logout()
    {
        return session()->forget('sd_cipher_access_token');
    }

    public static function getUserByUsername($username)
    {
        // if(env('CIPHER_MOCK')){
        //     return self::MockUser($username,"Mock User");
        // }
        $me = Cache::remember("cipher_username_{{$username}}", self::STANDARD_TTL, function () use ($username) {
            $res = Http::get(
                "https://system.sunnydiamonds.com/cipher/api/fetch/{$username}"
            );
            return $res->json();
        });
        if ($me) {
            // $sessions = $me['sessions'];
            unset($me['sessions']);
            $profile = $me;
            return self::CipherUser($profile, null);
        }
        throw new NotFoundHttpException("Cipher user not found against token {$username}");
    }

    public static function GetUserByAccessToken($token)
    {
        $me = Cache::remember("cipher_usertoken_{{$token}}", self::STANDARD_TTL, function () use ($token) {
            $res = Http::withToken($token)->get(
                "https://system.sunnydiamonds.com/cipher/api/me"
            );
            return $res->json();
        });
        if ($me) {
            $profile = $me['user'];
            unset($me['user']);
            $session = $me;
            return self::CipherUser($profile, $session);
        }
        throw new AuthenticationException("Cipher authentication error against token {$token}");
    }

    public function MockUser($username='admin',$name='System Administrator')
    {
        $jsonData = '{
            "id": 55,
            "user_username": "'.$username.'",
            "service": null,
            "token": "sn7smmk3IPehYM1t",
            "scopes": [],
            "expiry": "2024-02-08T18:22:52.000000Z",
            "created_at": "2024-02-07T18:22:52.000000Z",
            "updated_at": "2024-02-07T18:22:52.000000Z",
            "user": {
              "id": 1,
              "name": "'.$name.'",
              "image": null,
              "gender": "others",
              "birthday": "2024-02-01T11:08:11.000000Z",
              "username": "admin",
              "active": 1,
              "admin": 1,
              "company": "sunny diamonds pvt ltd",
              "department": "digital lab",
              "role": "manager",
              "code": null,
              "level": 1,
              "country": "india",
              "contact_number": null,
              "contact_email": "test",
              "created_at": "2024-02-01T11:08:12.000000Z",
              "updated_at": "2024-02-05T04:33:14.000000Z",
              "extended": {
                "disburse": {
                  "credit_limit": "123123"
                },
                "price_engine": {
                  "": "true"
                },
                "": {
                  "level": "1"
                }
              },
              "sessions": [
                {
                  "id": 56,
                  "user_username": "admin",
                  "service": null,
                  "token": "soLCE0TlYqBfJerX",
                  "scopes": [],
                  "expiry": "2024-02-09T04:37:35.000000Z",
                  "created_at": "2024-02-08T04:37:35.000000Z",
                  "updated_at": "2024-02-08T04:37:35.000000Z"
                }
              ]
            }
          }';
        $me = json_decode($jsonData, true);
        $profile = $me['user'];
        unset($me['user']);
        $session = $me;
        return self::CipherUser($profile, $session);
    }

    public static function RegisterHandler()
    {
        Auth::viaRequest('cipher', function ($request) {
            if (env('CIPHER_MOCK')) {
                return self::MockUser();
            }
            $token = self::SessionAccessToken();
            if ($token) {
                return self::GetUserByAccessToken($token);
            } else {
                return null;
            }
        });
    }
}