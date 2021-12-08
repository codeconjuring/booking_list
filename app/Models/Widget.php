<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;

    protected $casts    = ['contents' => 'array'];
    protected $fillable = ['name', 'contents'];

}
