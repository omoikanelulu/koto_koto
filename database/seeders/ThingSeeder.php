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
        for ($i = 0; $i < 20; $i++) {
            Thing::create([
                'user_id' => 1,
                'thing' => Str::random(20),
                'thing_flag' => rand(0, 1),
                'good_thing_order' => rand(1, 3),
                'bad_thing_order' => rand(1, 3),
                'bad_thing_workaround' => Str::random(100),
                'is_deleted' => rand(0, 1),
                'registration_date' => '2022-12-01 11:20:30',
            ]);
        }
    }
}
