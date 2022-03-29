<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narrator extends Model
{
    use HasFactory;
    protected $appends  = ['country_name', 'language_name', 'total_narration', 'narrator_name'];
    protected $fillable = ['name', 'countries_id', 'languages_id'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'countries_id', 'id');
    }

    public function getTotalNarrationAttribute()
    {
        return BookInfo::where('narrator_id', $this->id)->get()->count();
    }

    public function getCountryNameAttribute()
    {
        if($this->countries_id == null){return null;}
    
    	$country = Country::where('id', $this->countries_id)->first();
    	return $country->name;
    }

    public function getLanguageNameAttribute()
    {
        if($this->languages_id == null){return null;}
        
        $language = Language::where('id', $this->languages_id)->first();
        return $language->name;
    }

    public function getNarratorNameAttribute()
    {
        return $this->name;
    }
}
