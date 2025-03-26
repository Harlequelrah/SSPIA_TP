<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $user = User::create(
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => 'mdrbroyoubastard',
                'role' => 'Administrateur',
                'username' => 'john_doe'
                ]
        );
        return $user;
    }
}
