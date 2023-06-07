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
    use HasFactory, SoftDeletes;

    // Thingモデルにテーブル名とプライマリキーを設定する
    protected $table = 'things';
    protected $primaryKey = 'id';

    // registration_dateをCarbonインスタンスとして扱う設定
    protected $dates = ['registration_date'];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * thing一覧を表示する
     *
     * ログインしているユーザのIDと記録されたthingのユーザIDが一致した物を全て取得する
     * 現状使用していないメソッド（2023/05/25）
     *
     * @return collection
     */
    // public function showThing()
    // {
    //     $user_id = Auth::id();
    //     $id = $this->id;
    //     $thing = $this->where('user_id', $user_id)
    //         ->where('id', $id)
    //         ->get();

    //     return $thing;
    // }

    /**
     * 指定した期間のthing一覧を取得する
     *
     * @param string $search_month 年月が入る yyyy-mm
     * @return collection
     */
    public function searchThing($search_month)
    {
        // ログイン中のユーザID
        $user_id = Auth::id();
        $things = $this->where([
            ['user_id', '=', $user_id],
            ['registration_date', '>=', $search_month . '-01 00:00'],
        ])
            ->orderBy('registration_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return $things;
    }

    /**
     * リレーション
     */
    public function users()
    {
        // 複数あるThingはひとつのユーザを持っている
        return $this->belongsTo(\App\Models\User::class);
    }
}
