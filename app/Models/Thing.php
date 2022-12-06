<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Thing extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function indexThing()
    {
        $user_id = Auth::id();
        $things = $this->where('user_id', $user_id)
            ->orderBy('registration_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return $things;
    }
    /**
     * リレーション
     */
    public function user()
    {
        return $this->hasMany(\App\Models\Thing::class);
    }
}
