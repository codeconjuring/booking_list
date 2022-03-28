<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionTitle extends Model
{
    use HasFactory;
    protected $fillable = ['production_department_id', 'title_id', 'lan', 'quantity'];

    public function book_list()
    {
    	return $this->belongsTo(BookList::class,'title_id','id');
    }
}
