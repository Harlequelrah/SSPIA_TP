<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPlot
 */
class Plot extends Model
{
    protected $fillable=[
        'name',
        'area',
        'crop_type',
        'plantation_date',
        'status',
        'user_id'
    ];

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function interventions(){
        return $this->hasMany(Intervention::class);
    }
}
