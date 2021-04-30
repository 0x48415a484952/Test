<?php

namespace App\Cart;

use App\Models\User;

class Cart 
{
    protected $user;

    protected $changed = false;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
