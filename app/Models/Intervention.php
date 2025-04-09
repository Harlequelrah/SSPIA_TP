<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperIntervention
 */
class Intervention extends Model
{

        protected $fillable=[
        'description',
        'product_used_name',
        'product_used_quantity',
        'intervention_type',
        'intervention_date',
        'user_id',
        'plot_id',
        'unit'
    ];

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function plot()
    {
        return $this->belongsTo(Plot::class);}
}
