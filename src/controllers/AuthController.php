<?php

namespace App\Controllers;

use App\Models\Auth;

class AuthController {
    private $auth;

    public function __construct() {
        $this->auth = new Auth();
    }

    public function login($user, $password) {
        return $this->auth->login($user, $password);
    }
}
