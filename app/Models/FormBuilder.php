<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormBuilder extends Model
{
    use HasFactory;
    // protected $casts = ['content' => 'array'];

    // public const TABLE_STATUS = ['Done', 'Progress', 'ToDo'];

    protected $fillable = ['label', 'type', 'order_table'];
}
