<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionDepartment extends Model
{
    use HasFactory;

    protected $appends = ["total_production_titles"];
    protected $fillable = ['production_house_id', 'production_year', 'production_month', 'stat_type', 'total_cost'];

    function production_house()
    {
    	return $this->belongsTo(ProductionHouse::class, 'production_house_id', 'id');
    }

    function production_title()
    {
    	return $this->hasMany(ProductionTitle::class, 'production_department_id', 'id');
    }

    function getTotalProductionTitlesAttribute()
    {
        return $this->hasMany(ProductionTitle::class)->where('production_department_id', $this->id)->sum('quantity');
    }

    function getStatTypeAttribute($value)
    {
        if($value == "1"){return "Books";}
        else{
            return "Tracts";
        }
    }
}
