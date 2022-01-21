<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookListCategory extends Model
{
    use HasFactory;
    protected $fillable = ['book_list_id', 'cat_id'];

    public function category()
    {
        return $this->belongsTo(Cat::class, 'cat_id', 'id');
    }
}
