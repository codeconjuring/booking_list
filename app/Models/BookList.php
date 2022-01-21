<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookList extends Model
{
    use HasFactory;
    protected $casts    = ['content' => 'array'];
    protected $appends  = ['available_status', 'report_available_status'];
    protected $fillable = ['category_id', 'title', 'available', 'author', 'language', 'content', 'book_id', 'add_another_book_translation'];

    public function serise()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(BookListCategory::class, 'book_list_id', 'id');
    }

    public function getAvailableStatusAttribute()
    {
        $available = $this->available;
        if ($available == 0) {
            return '<span class="badge badge-danger">No</span>';
        } elseif ($available == 1) {
            return '<span class="badge badge-success">Yes</span>';
        } else {
            return '<span class="badge badge-info">N/A</span>';
        }
    }

    public function getReportAvailableStatusAttribute()
    {
        $available = $this->available;
        if ($available == 0) {
            return 'No';
        } elseif ($available == 1) {
            return 'Yes';
        } else {
            return 'N/A';
        }
    }

}
