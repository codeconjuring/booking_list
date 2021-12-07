<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookListTitle extends Model
{
    use HasFactory;

    protected $fillable = ['book_list_id', 'title', 'parent', 'parent_id'];

    public function parent_data()
    {
        return $this->belongsTo(BookList::class, 'book_list_id', 'id')->withDefault();
    }
}
