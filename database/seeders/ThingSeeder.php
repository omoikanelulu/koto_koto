<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Thing;

class ThingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('things')->truncate(); //2回目実行の際にシーダー情報をクリア
        for ($i = 0; $i < 30; $i++) {
            Thing::create([
                'user_id' => 1,
                'thing' => 'これはテスト用のデータです。' . $i,
                'good_thing_order' => rand(1, 3),
                'bad_thing_order' => rand(1, 3),
                'bad_thing_workaround' => 'これはテスト用のデータです。' . $i,
                'registration_date' => date('Y:m:d H:i:s', strtotime('-' . $i . ' day')),
            ]);
        }
    }
}
