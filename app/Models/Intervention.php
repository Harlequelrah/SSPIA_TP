<?php

namespace App\Models;

use App\Enums\InterventionTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Enums\UnitEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperIntervention
 */
class Intervention extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid();
            }
        });
    }

    public $incrementing = false;

    protected $keyType = 'string';


    protected $fillable = [
        'description',
        'product_used_name',
        'product_used_quantity',
        'intervention_type',
        'intervention_date',
        'user_id',
        'plot_id',
        'unit'
    ];

    protected $guarded = [];

    protected $casts = [
    'unit' => UnitEnum::class,
    'intervention_type' => InterventionTypeEnum::class,
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }
}
