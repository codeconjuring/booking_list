<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookList extends Model
{
    use HasFactory;
    protected $casts    = ['content' => 'array'];
    protected $fillable = ['category_id', 'title', 'language', 'content', 'book_id', 'add_another_book_translation'];

    public function serise()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
