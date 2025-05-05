<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('password can be updated', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->put('/password', [
            'current_password'          => 'password',
            'new_password'              => 'new-password',
            'new_password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/login');

    $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->put('/password', [
            'current_password'          => 'wrong-password',
            'new_password'              => 'new-password',
            'new_password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasErrors('current_password') // Vérifie que l'erreur est bien sur le champ `current_password`
        ->assertRedirect('/profile'); // L'utilisateur reste sur la page `/profile`
});
