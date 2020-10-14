<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function withNickname($name, $nickname)
    {
        $name = ucfirst($name);

        return "Hola {$name}, tu apodo es {$nickname}";
    }

    public function withoutNickname($name)
    {
        $name = ucfirst($name);

        return "Hola {$name}";
    }

    public function age($age = null)
    {
        if ($age) {
            return "Hola tu edad es {$age}";
        }

        return "Hola no colocaste tu edad";
    }
}
