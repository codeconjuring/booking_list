<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormBuilder extends Model
{
    use HasFactory;
    // protected $casts = ['content' => 'array'];

    // public const TABLE_STATUS = ['Done', 'Progress', 'ToDo'];

    protected $fillable = ['label', 'type', 'order_table', 'default_status_id'];

    public function default_status()
    {
        return $this->belongsTo(Status::class, 'default_status_id', 'id')->withDefault();
    }
}
