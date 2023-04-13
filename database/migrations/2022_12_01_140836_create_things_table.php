<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('things', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('ユーザのID');
            $table->string('thing')->comment('デキゴト');
            $table->tinyInteger('thing_flag')->comment('0:評価なし|1:good|2:bad|3:どちらも');
            $table->tinyInteger('good_thing_order')->comment('イイコトの順位');
            $table->tinyInteger('bad_thing_order')->comment('ヤナコトの順位');
            $table->string('bad_thing_workaround')->comment('回避策');
            $table->tinyInteger('is_deleted')->comment('削除済みフラグ');
            $table->dateTime('registration_date')->comment('登録日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('things');
    }
};
