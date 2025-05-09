<?php

namespace Database\Seeders;

use App\Enums\StatusEnum;
use App\Enums\RoleEnum;
use App\Models\Plot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');
        
        // Types de cultures courantes en France
        $cropTypes = [
            'Blé', 'Maïs', 'Orge', 'Colza', 'Tournesol', 'Betterave sucrière',
            'Pomme de terre', 'Vigne', 'Luzerne', 'Avoine', 'Seigle', 'Pois',
            'Féverole', 'Lin', 'Soja', 'Sorgho', 'Lentille', 'Chanvre'
        ];
        
        // Récupérer tous les utilisateurs qui sont des agriculteurs
        $users = User::whereIn('role', [RoleEnum::AGRICULTEUR->value])->get();
        
        $this->command->info('Nombre d\'agriculteurs trouvés: ' . count($users));
        
        $totalPlots = 0;
        
        foreach ($users as $user) {
            $plotCount = rand(3, 8);
            $this->command->info('Création de ' . $plotCount . ' parcelles pour l\'utilisateur ' . $user->name);
            
            for ($i = 0; $i < $plotCount; $i++) {
                $statusValues = [StatusEnum::EN_C->value, StatusEnum::EN_J->value, StatusEnum::RCLT->value];
                
                Plot::create([
                    'name' => 'Parcelle ' . $faker->word . ' ' . $faker->randomNumber(2),
                    'area' => $faker->randomFloat(2, 0.5, 25), // Superficie entre 0.5 et 25 hectares
                    'crop_type' => $faker->randomElement($cropTypes),
                    'plantation_date' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                    'status' => $faker->randomElement($statusValues),
                    'user_id' => $user->id,
                    'latitude' => $faker->latitude(43.0, 51.0),  // Coordonnées pour la France
                    'longitude' => $faker->longitude(-1.0, 8.0), // Coordonnées pour la France
                ]);
                
                $totalPlots++;
            }
        }
        
        $this->command->info($totalPlots . ' parcelles ont été créées avec succès !');
    }
}