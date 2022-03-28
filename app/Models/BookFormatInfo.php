<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookFormatInfo extends Model
{
    use HasFactory;
    protected $fillable = ['book_list_id', 'form_builder_id', 'price', 'modification_year'];

    public function formbuilders()
    {
    	return $this->belongsTo(FormBuilder::class, 'form_builder_id', 'id');;
    }
}
