<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the admin user already exists
        $adminEmail = 'admin@gmail.com';
        $agriEmail = "agri@gmail.com";
        $agriEmail2 = 'agri2@gmail.com';

        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => $adminEmail,
                'username' => 'Admin',
                'role' => RoleEnum::ADMIN->value, // Utilisation de ->value
                'password' => Hash::make('admin@2064'),
                'email_verified_at' => now(),
            ]);

            $this->command->info('Admin user created successfully!');
        } else {
            $this->command->info('Admin user already exists. Skipped creation.');
        }
        if (!User::where('email', $agriEmail)->exists()) {
            User::create([
                'name' => 'Agriculteur',
                'email' => $agriEmail,
                'username' => 'Agri',
                'role' => RoleEnum::AGRICULTEUR->value, // Utilisation de ->value
                'password' => Hash::make('admin@2064'),
                'email_verified_at' => now(),
            ]);

            $this->command->info('Agriculteur user created successfully!');
        } else {
            $this->command->info('Agriculteur user already exists. Skipped creation.');
        }
        if (!User::where('email', $agriEmail2)->exists()) {
            User::create([
                'name' => 'Agriculteur 2',
                'email' => $agriEmail2,
                'username' => 'Agri3',
                'role' => RoleEnum::AGRICULTEUR->value, // Utilisation de ->value
                'password' => Hash::make('admin@2064'),
                'email_verified_at' => now(),
            ]);

            $this->command->info('Agriculteur 2 user created successfully!');
        } else {
            $this->command->info('Agriculteur 2 user already exists. Skipped creation.');
        }
        
        // Ajout d'un autre agriculteur pour assurer qu'il y a suffisamment d'utilisateurs
        $agriEmail3 = 'agri3@gmail.com';
        if (!User::where('email', $agriEmail3)->exists()) {
            User::create([
                'name' => 'Agriculteur 3',
                'email' => $agriEmail3,
                'username' => 'Agri3',
                'role' => RoleEnum::AGRICULTEUR->value,
                'password' => Hash::make('admin@2064'),
                'email_verified_at' => now(),
            ]);

            $this->command->info('Agriculteur 3 user created successfully!');
        }
    }
}