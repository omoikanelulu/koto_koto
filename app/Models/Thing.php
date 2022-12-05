<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Thing extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    /**
     * リレーション
     */
    public function user()
    {
        return $this->hasMany(\App\Models\Thing::class);
    }
}
