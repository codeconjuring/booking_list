<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as spatiePermission;

class Permission extends spatiePermission
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }

}
