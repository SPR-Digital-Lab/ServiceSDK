<?php

namespace SPR\ServiceSDK\Cipher;

use Illuminate\Contracts\Auth\Authenticatable;
use Livewire\Wireable;

class CipherUser implements Authenticatable, Wireable
{
    public $profile;
    public $session;

    function getAuthIdentifierName()
    {
        return "username";
    }

    function getAuthIdentifier()
    {
        return $this->username;
    }

    function getAuthPassword()
    {

    }

    function getRememberToken()
    {
        return $this->token;
    }

    function setRememberToken($value)
    {

    }

    public function toLivewire()
    {
        return [
            "profile" => $this->profile,
            "session" => $this->session,
        ];
    }

    public static function fromLivewire($value)
    {
        $cipher = new static();
        $cipher->profile = $value['profile'];
        $cipher->session = $value['session'];
        return $cipher;
    }

    public function __get(string $name)
    {
        if (isset($this->profile[$name]))
            return $this->profile[$name];
        elseif (isset($this->session[$name]))
            return $this->session[$name];
        else
            return null;
    }

    function getRememberTokenName()
    {
        return "token";
    }

    public function hasPosition($department, $role)
    {
        if ($this->admin)
            return true;
        if ($department == "*") {
            if ($role == $this->role)
                return true;
        }
        if ($role == "*") {
            if ($department == $this->department)
                return true;
        }
        if ($department == "*" && $role == "*")
            return true;

        if ($department == $this->department && $role == $this->role)
            return true;
    }

    public function canRaiseRequests()
    {
        return true;
    }


    public function canViewRequests()
    {
        return true;
    }

    public function canEditRequests()
    {
        // return $this->role == "support" || $this->role == "finance" || $this->role == "purchase";
        return true;
    }

    public function canApproveRequests()
    {
       return $this->hasPosition("*","manager");
    }

    public function canViewOrders()
    {
        return $this->role == "support" || $this->role == "finance" || $this->role == "purchase";
    }
}