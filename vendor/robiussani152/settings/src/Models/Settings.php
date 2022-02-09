<?php

namespace Robiussani152\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = ['setting_key', 'setting_value'];
}
