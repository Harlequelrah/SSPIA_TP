<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperPlot
 */

use Illuminate\Support\Str;

class Plot extends Model
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
        static::deleting(function ($plot) {
    // Soft delete les interventions associées
    $plot->interventions()->delete();
});

    }

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'area',
        'crop_type',
        'plantation_date',
        'status',
        'user_id',
        'latitude' ,
        'longitude',
    ];

    protected $guarded = [];

    protected $casts = [
        'status' => StatusEnum::class,
        'area' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }


}
