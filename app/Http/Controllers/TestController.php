<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function index()
    {
        $user1 = User::create(
            [
                'name'     => 'John Doe',
                'email'    => 'john.doe@example.com',
                'password' => 'mdrbroyoubastard',
                'role'     => 'Administrateur',
                'username' => 'john_doe',
            ]
        );
        $user2 = User::create(
            [
                'name'     => 'Jane Doe',
                'email'    => 'jane.doe@example.com',
                'password' => Hash::make('0000'),
                'role'     => 'Administrateur',
                'username' => 'jane_doe',
            ]
        );

        return $user2;
    }
}
