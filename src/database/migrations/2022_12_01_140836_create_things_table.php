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
            $table->string('thing')->default('')->comment('デキゴト');
            $table->tinyInteger('thing_flag')->default(0)->comment('0:評価なし|1:good|2:bad|3:どちらも');
            $table->tinyInteger('good_thing_order')->default(0)->comment('イイコトの順位');
            $table->tinyInteger('bad_thing_order')->default(0)->comment('ヤナコトの順位');
            $table->string('bad_thing_workaround')->default('')->comment('回避策');
            $table->tinyInteger('is_deleted')->default(0)->comment('削除済みフラグ');
            $table->dateTime('registration_date')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('登録日');
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
