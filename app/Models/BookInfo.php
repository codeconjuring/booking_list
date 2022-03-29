<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookInfo extends Model
{
    use HasFactory;
    protected $fillable = ['book_list_id', 'cover_file_name', 'epub_file_name', 'audio_file_name', 'narrator_id', 'proofreader_id', 'pages', 'to_read', 'to_listen', 'synopsis'];

    public function narrators()
    {
    	return $this->belongsTo(Narrator::class, 'narrator_id', 'id');
    }

    public function proofreaders()
    {
    	return $this->belongsTo(ProofReader::class, 'proofreader_id', 'id');
    }
}
