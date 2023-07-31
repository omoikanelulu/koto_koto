<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inquiry::create([
            'id' => 1,
            'name' => '武田信玄',
            'email' => 'shingen@gmail.com',
            'inquiry' => 'お問い合わせ内容',
            'status' => 0,
        ]);
    }
}
