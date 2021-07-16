<?php

namespace App\Contracts\Authentication;

interface LoginUserData
{
    public function login(): string;
    public function password(): string;
}