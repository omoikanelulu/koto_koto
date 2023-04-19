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
        Schema::table('things', function (Blueprint $table) {
            $table->dropColumn('thing_flag');
            $table->dropColumn('is_deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('things', function (Blueprint $table) {
            $table->tinyInteger('thing_flag')->default(0)->comment('0:評価なし|1:good|2:bad|3:どちらも');
            $table->tinyInteger('is_deleted')->default(0)->comment('削除済みフラグ');
        });
    }
};
