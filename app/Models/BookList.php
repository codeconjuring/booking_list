<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookList extends Model
{
    use HasFactory;
    protected $casts    = ['content' => 'array'];
    protected $appends  = ['available_status', 'report_available_status', 'serieswise_lan', 'serieslanwise_title', 'titlewise_tags', 'titlewise_author'];
    protected $fillable = ['category_id', 'title', 'available', 'author', 'language', 'links', 'content', 'book_id', 'add_another_book_translation'];

    public const ZTF = ['1' => 'Yes', '0' => 'No', '2' => 'Not Available'];

    public function books()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function serise()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(BookListCategory::class, 'book_list_id', 'id');
    }

    public function bookInfos()
    {
        return $this->hasOne(BookInfo::class, 'book_list_id', 'id');
    }

    public function bookFormatInfos()
    {
        return $this->hasMany(BookFormatInfo::class, 'book_list_id', 'id');
    }

    public function getAvailableStatusAttribute()
    {
        // $available = $this->available;
        $available = 0;
        $available_query = BookList::where([['book_id', $this->book_id], ['language', 'en']])->first();
        if($available_query)
        {
            $available = $available_query->available;
        }
        if ($available == 0) {
            return '<span class="badge bg-danger">No</span>';
        } elseif ($available == 1) {
            return '<span class="badge bg-success">Yes</span>';
        } else {
            return '<span class="badge bg-info">N/A</span>';
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

    public function getSerieswiseLanAttribute()
    {
        return $this->select('language')->where('category_id',$this->category_id)->distinct()->get();
    }

    public function getSerieswiseTitleAttribute()
    {
        return $this->where('category_id',$this->category_id)->distinct('book_id')->get(['id','title']);
    }

    public function getSerieslanwiseTitleAttribute()
    {
        return $this->where([['category_id',$this->category_id],['language', $this->language]])->distinct('book_id')->get(['id','title']);
    }

    public function getTitleWiseTagsAttribute()
    {
        $booklist_id = 0;
        $booklist_id_query = BookList::where([['book_id', $this->book_id],['language', 'en']])->first();
        if($booklist_id_query)
        {
            $booklist_id = $booklist_id_query->id;
        }
        return BookListCategory::where('book_list_id', $booklist_id)->get();
    }

    public function getTitleWiseAuthorAttribute()
    {
        $author = '';
        $author_query = BookList::where([['book_id', $this->book_id],['language', 'en']])->first();
        if($author_query)
        {
            $author = $author_query->author;
        }
        return $author;
    }
}
