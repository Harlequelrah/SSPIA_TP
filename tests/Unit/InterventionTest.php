<?php
namespace Tests\Unit;

use App\Enums\InterventionTypeEnum;
use App\Enums\UnitEnum;
use App\Models\Intervention;
use PHPUnit\Framework\TestCase;

class InterventionTest extends TestCase
{
    public function test_fillable_attributes()
    {
        $intervention = new Intervention();

        $fillable = [
            'description',
            'product_used_name',
            'product_used_quantity',
            'intervention_type',
            'intervention_date',
            'user_id',
            'plot_id',
            'unit',
        ];

        $this->assertEquals($fillable, $intervention->getFillable());
    }

    public function test_casts()
    {
        $intervention = new Intervention();

        $casts = [
            'unit'              => UnitEnum::class,
            'intervention_type' => InterventionTypeEnum::class,
            'deleted_at'=> 'datetime'
        ];

        $this->assertEquals($casts, $intervention->getCasts());
    }
}
