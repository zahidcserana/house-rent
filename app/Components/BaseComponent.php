<?php

namespace App\Components;

class BaseComponent
{
    public function adminUser()
    {
        return Auth()->user()->isAdmin();
    }
}
