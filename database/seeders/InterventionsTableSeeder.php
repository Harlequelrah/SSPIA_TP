<?php

namespace Database\Seeders;

use App\Enums\InterventionTypeEnum;
use App\Enums\UnitEnum;
use App\Models\Intervention;
use App\Models\Plot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InterventionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');
        
        // Produits phytosanitaires et engrais courants
        $products = [
            'Roundup' => ['L', 'kg'],
            'Glyphosate' => ['L', 'kg'],
            'NPK 15-15-15' => ['kg'],
            'Urée 46%' => ['kg'],
            'Ammonitrate' => ['kg'],
            'Bouillie bordelaise' => ['kg'],
            'Fongicide Systémique' => ['L'],
            'Insecticide Naturel' => ['L'],
            'Régulateur de Croissance' => ['L'],
            'Solution Azotée' => ['L'],
            'Chaux Agricole' => ['kg'],
            'Compost Organique' => ['t'],
            'Fumier Composté' => ['t'],
            'Purin d\'Ortie' => ['L'],
            'Bactériosol' => ['kg']
        ];

        // Types d'intervention
        $interventionTypes = [
            InterventionTypeEnum::TR->value, 
            InterventionTypeEnum::FT->value, 
            InterventionTypeEnum::RC->value, 
            InterventionTypeEnum::SM->value, 
            InterventionTypeEnum::AR->value
        ];
        
        // Récupérer toutes les parcelles
        $plots = Plot::all();
        $this->command->info('Nombre de parcelles trouvées: ' . count($plots));
        
        $totalInterventions = 0;
        
        foreach ($plots as $plot) {
            // Générer entre 10 et 20 interventions par parcelle
            $interventionCount = rand(10, 20);
            $this->command->info('Création de ' . $interventionCount . ' interventions pour la parcelle ' . $plot->name);
            
            for ($i = 0; $i < $interventionCount; $i++) {
                // Sélectionner un type d'intervention
                $interventionType = $faker->randomElement($interventionTypes);
                
                // Logique pour sélectionner un produit et une unité appropriés en fonction du type d'intervention
                $productName = '';
                $unit = null;
                
                if ($interventionType === InterventionTypeEnum::TR->value || $interventionType === InterventionTypeEnum::FT->value) {
                    $productName = $faker->randomElement(array_keys($products));
                    $possibleUnits = $products[$productName];
                    $unitValue = $faker->randomElement($possibleUnits);
                    
                    switch ($unitValue) {
                        case 'L':
                            $unit = UnitEnum::L->value;
                            break;
                        case 'kg':
                            $unit = UnitEnum::KG->value;
                            break;
                        case 't':
                            $unit = UnitEnum::T->value;
                            break;
                        default:
                            $unit = UnitEnum::L->value;
                    }
                }else {
                    $unit = UnitEnum::KG->value;
                }
                
                // Créer l'intervention
                Intervention::create([
                    'description' => $faker->sentence(rand(10, 20)),
                    'product_used_name' => $interventionType === InterventionTypeEnum::TR->value || $interventionType === InterventionTypeEnum::FT->value ? $productName : null,
                    'product_used_quantity' => $interventionType === InterventionTypeEnum::TR->value || $interventionType === InterventionTypeEnum::FT->value ? $faker->randomFloat(2, 0.5, 50) : null,
                    'intervention_type' => $interventionType,
                    'intervention_date' => $faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
                    'user_id' => $plot->user_id,
                    'plot_id' => $plot->id,
                    'unit' => $unit
                ]);
                
                $totalInterventions++;
            }
        }
        
        $this->command->info($totalInterventions . ' interventions ont été créées avec succès !');
    }
}