<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Thing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function showThing()
    {
        $user_id = Auth::id();
        $id = $this->id;
        $thing = $this->where('user_id', $user_id)
            ->where('id', $id)
            ->get();

        return $thing;
    }

    public function searchThing($search_month)
    {
        $user_id = Auth::id();
        $things = $this->where([
            ['user_id', '=', $user_id],
            ['registration_date', '>=', $search_month . '-01 00:00'],
        ])
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
        // 複数あるThingはひとつのユーザを持っている（分かりにくい）
        return $this->belongsTo(\App\Models\User::class);
    }
}
