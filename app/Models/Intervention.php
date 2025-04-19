<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


/**
 * @mixin IdeHelperIntervention
 */
class Intervention extends Model
{
    use SoftDeletes;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plot()
    {
        return $this->belongsTo(Plot::class);
    }
}
